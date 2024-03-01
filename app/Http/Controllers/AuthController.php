<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Campus;
use App\Models\Country;
use App\Models\Participant;
use App\Models\RegistrationMail;
use App\Models\SuccessfulRegistration;
use App\Models\User;
use App\Models\Zone;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLogin()
    {
        if(session('user')){
            return redirect()->route('home');
        }
        return view('auth.login');
    }

    public function showSignIn($username = 'admin')
    {
        if(session('guest')){
            return redirect()->route('guest');
        }
        $data['refer'] = User::whereUsername($username)->firstOrFail();
        $data['countries'] = Country::all();
        return view('auth.signin',$data);
    }

    public function showRegister($username = 'admin')
    {

        $data['refer'] = User::whereUsername($username)->firstOrFail();
        $data['countries'] = Country::all();
        $data['zones'] = Zone::all();
        $data['campus'] = Campus::all();
        return view('auth.register', $data);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::whereEmail($request->email)->first();
        if(!$user){
            return back()->withInput()->with('error', 'Incorrect credentials');
        }

        $validated = password_verify($request->password, $user->password);
        if(!$validated){
            return back()->withInput()->with('error', 'Incorrect credentials');
        }

        if($user->status == 'inactive'){
            return back()->withInput()->with('error', 'Please check your mailbox for verification link');
        }

        if($user->status == 'banned'){
            return back()->withInput()->with('error', 'This account has been flagged. Please contact administrator.');
        }

        session()->put('user', $user);
        return to_route('home');


    }

    public function signIn(Request $request, $username = 'admin')
    {

        $request->validate([
            'email' => 'required|email',
            'name' => 'required',
            'referral_id' => 'required',
//            'phone' => 'required',
            'country' => 'required',
        ]);

        $refer = User::findOrFail($request->referral_id);

        $userExists = Participant::whereEmail($request->email)->exists();
        if($userExists){
            session()->put('guest', $userExists);
            return to_route('guest')->with('message', 'Welcome to Influencers Network');
        }

        $user = new Participant();
        $user->referral_id = $refer->id;
        $user->email = $request->email;
        $user->name = $request->name;
//        $user->phone = $request->phone;
        $user->country = $request->country;
        $user->save();
        session()->put('guest', $user);
        return to_route('guest')->with('message', 'Welcome to Influencers Network');
    }

    public function register(Request $request, $username = 'admin')
    {

        $request->validate([
            'referral_id' => 'required',
            'email' => 'required|unique:users|email',
            'username' => 'required|unique:users|alpha_dash|min:4',
            'name' => 'required',
            'phone' => 'required',
            'city' => 'required',
            'country' => 'required',
            'password' => 'required|confirmed',
            'birth_month' => 'required',
            'birth_date' => 'required'
        ],[

            'username.required' => 'The username field is required.',
            'email.unique' => 'This email is already taken.',
            'username.unique' => 'This username is already taken.',
            'username.alpha_dash' => 'The username may only contain letters, numbers, dashes, and underscores.',
            'username.min' => 'The username must be at least 4 characters.'

        ]);


        $refer = User::findOrFail($request->referral_id);

        $userExists = User::whereEmail($request->email)->orWhere('username', $request->username)->exists();
        if($userExists){
            return back()->withInput()->with('error', 'User exists already');
        }

        $verification_code = md5(time()) . md5(uniqid());

        $user = new User();
        $user->referral_id = $refer->id;
        $user->email = $request->email;
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->birth_month = $request->birth_month;
        $user->birth_date = $request->birth_date;
        $user->username = $request->username;
        $user->church = $request->church;
        $user->zone = $request->zone;
        $user->image = url('avatar/default.png');
        $user->country = $request->country;
        $user->password = bcrypt($request->password);
        $user->verification_code = $verification_code;
        $user->status = 'inactive';
        $user->save();

        $mail = new RegistrationMail();
        $mail->email = $user->email;
        $mail->username = $user->username;
        $mail->verification_code = $user->verification_code;
        $mail->save();

        return view('auth.success');
    }

    public function verifyRegistration($username, $code)
    {
        $user = User::whereStatusAndUsernameAndVerificationCode('inactive', $username, $code)->firstOrFail();
        $user->status = 'active';
        $user->verification_code = null;
        $user->save();

        $s = new SuccessfulRegistration();
        $s->name = $user->name;
        $s->email = $user->email;
        $s->username = $user->username;
        $s->save();

        session()->put('user', $user);

        return to_route('home')->with('message', 'Welcome to Influencers Network');
    }

    public function showAdminLogin()
    {
        if(session('admin')){
            return redirect()->route('admin');
        }
        return view('backend.admin_login');
    }

    public function adminLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $admin = Admin::whereEmailAndStatus($request->email, 'active')->first();
        if(!$admin){
            return back()->withInput()->with('error', 'User not found');
        }

        $v = password_verify($request->password, $admin->password);
        if(!$v){
            return back()->withInput()->with('error', 'Incorrect credentials');
        }

        session()->put('admin', $admin);
        return to_route('adminDashboard');
    }

    public function showZoneRegister($zone)
    {
        $data['page_title'] = 'Register';
        $data['zone'] = Zone::where('short_name', $zone)->firstOrFail();
        $zoneName=  $data ['zone']['name'];
        $data['zoneName'] = $zoneName;
        $data['countries'] = Country::all();
        return view('auth.zone_register', $data);
     }

    public function showCampusRegister($campus)
    {
        $data['page_title'] = 'Register';
        $data['campus'] = Campus::where('short_name', $campus)->firstOrFail();
        $campusName=  $data ['campus']['name'];
        $data['campusName'] = $campusName;
        $data['countries'] = Country::all();
        return view('auth.campus_register', $data);
     }

    public function showCampusSignIn($campus)
    {
        $data['page_title'] = 'Sign In';
        $data['campus'] = Campus::where('short_name', $campus)->firstOrFail();
        $campusName=  $data ['campus']['name'];
        $data['campusName'] = $campusName;
        $data['countries'] = Country::all();
        return view('auth.campus_signin', $data);
     }
    public function showZoneSignIn($zone)
    {
        $data['page_title'] = 'Sign In';
        $data['zone'] = Zone::where('short_name', $zone)->firstOrFail();
        $zoneName=  $data ['zone']['name'];
        $data['zoneName'] = $zoneName;
        $data['countries'] = Country::all();
        return view('auth.zone_signin', $data);
    }
    public function logout()
    {
        session()->flush();
        return to_route('login');
    }
}
