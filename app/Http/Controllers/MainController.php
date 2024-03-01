<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Models\Participant;
use App\Models\Prayer;
use App\Models\Slide;
use App\Models\Testimony;
use App\Models\User;
use Illuminate\Http\Request;

class MainController extends Controller
{
    //

    public function index()
    {
        $data['page_title'] = 'Home';
        $data['i'] = 1;
        $programmes = Meeting::where('end_date', '>=', date('Y-m-d H:i:s'))->latest()->limit(3)->get();
        foreach($programmes as $programme){
            $programme->startSeconds = strtotime($programme->start_date);
        }
        $data['meetings'] = $programmes;
        $data['slides'] = Slide::all();

        return view('guests.home', $data);
    }

    public function guestTestimony()
    {
        $data['page_title'] = 'Share Testimony';
        return view('guests.testimony', $data);
    }

    public function submitGuestTestimony(Request $request)
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


    public function guestPrayerRequest()
    {
        $data['page_title'] = 'Prayer Requests';
        return view('guests.prayers', $data);
    }

    public function submitGuestPrayer(Request $request)
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

    public function showSoul($username)
    {
        $data['page_title'] = 'Salvation';
        $data['username'] = User::where('username', $username)->firstOrFail();
        return View('influencers.salvation', $data);
    }

    public function soul(Request $request)
    {

    }
}
