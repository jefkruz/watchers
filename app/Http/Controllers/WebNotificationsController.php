<?php

namespace App\Http\Controllers;

use App\Models\ViewedNotification;
use App\Models\WebNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class WebNotificationsController extends Controller
{
    public static function fetchLatestNotifications()
    {
        return WebNotification::latest()->limit(5)->get();
    }

    public function createNotification($title, $type, $id = null, $slug = null)
    {
        $link = null;
        if($type == 'course'){
            $link = route('previewCourse', $id);
        }

        if($type == 'programme'){
            $link = route('meetings');
        }

        if($type == 'post'){
            $link = route('viewResource', [$id, $slug]);
        }



        if($link == null){
            return false;
        }

        $notif = WebNotification::whereTitleAndLink($title, $link)->where('notification_type', $type)->first();
        if(!$notif){
            $notif = new WebNotification();
            $notif->title = $title;
            $notif->notification_type = $type;
            $notif->link = $link;
            $notif->save();
        }

        return true;
    }

    public function viewNotification($id)
    {
        $user = Session::get('user');
        $notif = WebNotification::findOrFail($id);
        $viewed = ViewedNotification::where('user_id', $user->id)->where('notification_id', $notif->id)->first();
        if(!$viewed){
            $viewed = new ViewedNotification();
            $viewed->notification_id = $notif->id;
            $viewed->user_id = $user->id;
            $viewed->save();
        }
        return redirect($notif->link);
    }

    public function notifications()
    {
        $data['notifications'] = WebNotificationsController::fetchLatestNotifications();
        $data['page_title'] = 'Notifications List';
        $data['all'] = WebNotification::latest()->get();
        return view('influencers.notifications', $data);
    }

    public function checkForNew()
    {
        $user = Session::get('user');
        $all = WebNotification::count();
        $viewed = ViewedNotification::where('user_id', $user->id)->count();
        $stat = ($all == $viewed) ? false : true;
        return response(['status' => $stat], 200);
    }
}
