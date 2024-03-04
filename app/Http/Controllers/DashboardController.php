<?php

namespace App\Http\Controllers;


use App\Models\Campus;
use App\Models\Download;
use App\Models\FirebaseToken;
use App\Models\Magazine;
use App\Models\Meeting;
use App\Models\Participant;
use App\Models\ResourcePost;
use App\Models\Slide;
use App\Models\TeamHead;
use App\Models\Training;
use App\Models\User;
use App\Models\Video;
use App\Models\WebNotification;
use App\Models\Zone;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data['notifications'] = WebNotificationsController::fetchLatestNotifications();
        $data['dash_menu'] = true;
        $data['page_title'] = 'Home';
        $data['slides'] = Slide::all();
        return view('dashboard', $data);
    }

    public function adminDashboard()
    {
        $data['page_title'] = 'Dashboard';
        $month = date('n');
        $data['birthdays'] = User::where('birth_month',$month)->get();
        $data['staffs'] = User::count();
        $data['notifiers'] = FirebaseToken::count();
        $data['teamHeads'] = TeamHead::count();
        $data['slides'] = Slide::count();
        $data['magazines'] = Magazine::count();
        $data['posts'] = ResourcePost::count();
        $data['participants'] = Participant::count();
        $data['videos'] = Video::count();
        $data['downloads'] = Download::count();

        $data['meetings'] = Meeting::count();
        $data['zones'] = Zone::count();
        $data['camps'] = Campus::count();
        $data['trainings'] = Training::count();
        $data['dash_menu'] = true;
        return view('backend.dashboard', $data);
    }


    public function pushNotification()
    {
        $data['page_title'] = 'Push Notification';
        $data['notif_menu'] = true;
        return view('backend.notification', $data);
    }

}
