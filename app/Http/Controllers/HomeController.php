<?php

namespace App\Http\Controllers;

use App\Models\App;
use App\Models\Campus;
use App\Models\Country;
use App\Models\Download;
use App\Models\FirebaseToken;
use App\Models\Magazine;
use App\Models\Meeting;
use App\Models\Participant;
use App\Models\Prayer;
use App\Models\PushNotification;
use App\Models\ResourcePost;
use App\Models\Slide;
use App\Models\Station;
use App\Models\Stream;
use App\Models\Streamurl;
use App\Models\Testimony;
use App\Models\Training;
use App\Models\User;
use App\Models\Video;
use App\Models\Website;
use App\Models\Zone;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class HomeController extends Controller
{

    protected $data;
    public function __construct()
    {
        $this->data['magazines'] = Magazine::all();
        $this->data['video'] = Video::where('status','active')->first();
        $this->data['stream'] = Stream::where('id',1)->first();


    }

    public function globalDirectories()
    {
        $data['stations'] = Station::all();
        $data['websites'] = Website::all();
        $data['apps'] = App::all();
        $data['meeting'] = Meeting::latest()->first();
        $data['page_title'] = 'Global Directories';
        return view('directories', $data);
    }


    public function index()
    {
        $data = $this->data;
        $isHead = session('user')->isTeamHead();
        $data['notifications'] = WebNotificationsController::fetchLatestNotifications();
        $data['page_title'] = 'Dashboard';
        $id = session('user.id');
        $data['i'] = 1;
        $programmes = Meeting::where('end_date', '>=', date('Y-m-d H:i:s'))->ofType($isHead)->latest()->limit(3)->get();
        foreach($programmes as $programme){
            $programme->startSeconds = strtotime($programme->start_date);
        }
        $data['resources'] = ResourcePost::ofType($isHead)->latest()->get();
        $data['meetings'] = $programmes;
        $referer = session('referral.id');
        $data['upline'] = User::where('id',$referer)->first();
        $data['download'] = Magazine::where('status','Active')->first();
        $data['slides'] = Slide::all();
        $data['stream'] = Stream::find(2);
        $data['referrals'] = User::where('referral_id',$id)->get();
        $data['participants'] = Participant::where('referral_id',$id)->get();
        $data['myDownloads'] = Download::where('user_id',$id)->get();

        return view('influencers.home', $data);
    }

    public function magazine()
    {
        $data['notifications'] = WebNotificationsController::fetchLatestNotifications();
        $data = $this->data;
        $data['page_title'] = 'Magazine';
        return view('influencers.magazine', $data);
    }

    public function downloadMagazine($username)
    {

        $user = User::whereUsername($username)->firstOrFail();
        $magazine = Magazine::where('status', 'active')->firstOrFail();
        $ipAddress = request()->ip();

        $existingDownload = Download::where('mag_id', $magazine->id)
            ->where('user_id',$user->id)
            ->where('ip_address', $ipAddress)
            ->first();

        if (!$existingDownload) {
            // Create a new download entry for the user
            $download = new Download();
            $download->mag_id = $magazine->id;
            $download->user_id = $user->id;
            $download->ip_address = $ipAddress;
            $download->save();


            // Update the download count for the magazine
            $magazine->increment('download_count');
        }
        return response()->download($magazine->file);


    }

    public function downloadCount()
    {
        $data['notifications'] = WebNotificationsController::fetchLatestNotifications();
        $id = session('user.id');
        $data['page_title'] = 'My Downloads';
        $data['i'] = 1;
        $data['downloads'] = Download::where('user_id',$id)->get();
        return view('influencers.downloads',$data);
    }

    public function saveToken(Request $request)
    {
        $request->validate([
            'newtoken' => 'required|string',
        ]);
        $token = FirebaseToken::where('token',$request->oldtoken)->first();
        if(!$token){
            $token = new FirebaseToken();
        }

        $id = session('user.id');
        $token->user_id = $id;
        $token->token = $request->newtoken;
        $token->save();

        return response()->json(['message' => 'Firebase token updated successfully']);

    }

    public function testimony()
    {
        $data['notifications'] = WebNotificationsController::fetchLatestNotifications();
        $data['page_title'] = 'Share Testimony';
        return view('influencers.testimony', $data);
    }

    public function submitTestimony(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'name' => 'required',
            'user_id' => 'required',
            'subject' => 'required',
            'testimony' => 'required',
        ]);
        $testify = Testimony::create($request->all());
        return redirect()->back()->with('success', 'Testimony Submission Successful.');
    }

    public function notifications()
    {
        $data = $this->data;
        $data['notifications'] = WebNotificationsController::fetchLatestNotifications();
        $data['page_title'] = 'Notifications';
        return view('influencers.notifications', $data);
    }

    public function prayerRequest()
    {
        $data['notifications'] = WebNotificationsController::fetchLatestNotifications();
        $data['page_title'] = 'Prayer Requests';
        return view('influencers.prayers', $data);
    }

    public function submitPrayer(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'name' => 'required',
            'user_id' => 'required',
            'subject' => 'required',
            'prayer' => 'required',
        ]);
        $prayed = Prayer::create($request->all());
        return redirect()->back()->with('success', 'Prayer Request Submission Successful.');
    }



    public function profile()
    {
        $data['notifications'] = WebNotificationsController::fetchLatestNotifications();
        $data['page_title'] = 'My Profile';
        $id = session('user.id');
        $user = Session::get('user');
        $data['i'] = 1;
        $data['countries'] = Country::all();
        $data['zones'] = Zone::all();
        $data['camps'] = Campus::all();
        $referer = session('user.referral_id');
        $data['user'] = $user;
        $data['upline'] = User::where('id',$referer)->first();
        $data['referrals'] = User::where('referral_id',$id)->get();
        return view('influencers.profile', $data);
    }

    public function updateProfile(Request $request)
    {
        $request->validate([

            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
            'birth_month' => 'required',
            'birth_date' => 'required'
        ]);
        $staff = Session::get('user');
        $user = User::find($staff->id);
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->birth_date = $request->birth_date;
        $user->birth_month = $request->birth_month;
        $user->city = $request->city;
        $user->state = $request->state;
        $user->country = $request->country;
        $user->church = $request->church;
        $user->zone = $request->zone;
        $user->campus = $request->campus;
        $user->save();
        session()->put('user', $user);
        return back()->with('success', 'Profile updated');
    }

    public function participants()
    {
        $data['notifications'] = WebNotificationsController::fetchLatestNotifications();
        $id = session('user.id');
        $data['page_title'] = 'Participants';
        $data['i'] = 1;
        $data['participants'] = Participant::where('referral_id',$id)->get();
        return view('influencers.participants',$data);
    }

    public function referrals()
    {
        $data['notifications'] = WebNotificationsController::fetchLatestNotifications();
        $id = session('user.id');
        $data['page_title'] = 'Influencers';
        $data['i'] = 1;
        $data['referrals'] = User::where('referral_id',$id)->get();
        return view('influencers.referrals',$data);
    }

    public function viewreferral($username)
    {
        $data['notifications'] = WebNotificationsController::fetchLatestNotifications();
        $data['page_title'] = 'Referrals';
        $referral = User::where('username',$username)->first();
        $data['referral'] = User::where('username',$username)->first();
        $data['i'] = 1;
        $user =$referral->id;
        $data['downlines'] = User::where('referral_id',$user)->get();

        return view('influencers.view_referrals',$data);
    }


}
