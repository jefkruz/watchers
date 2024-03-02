<?php

namespace App\Http\Controllers;

use App\Models\FirebaseToken;
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

    public function saveFirebaseToken(Request $request)
    {
        $request->validate([
            'newtoken' => 'required'
        ]);

        $user = Session::get('user');
        $t = FirebaseToken::where('user_id', $user->id)->where('platform', 'web')->first();
        if(!$t){
            $t = new FirebaseToken();
            $t->user_id = $user->id;
            $t->platform = 'web';
        }

        $t->token = $request->newtoken;
        $t->save();

        return response(['status' => true, 'message' => 'Token saved'], 200);

    }
    public function sendFirebaseNotification(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);
        $url ="https://fcm.googleapis.com/fcm/send";

        $registrationIds = [];
        $tokens = FirebaseToken::all();

        foreach($tokens as $token){

            array_push($registrationIds, $token->token);
        }

        $fields=array(
            "registration_ids"=> $registrationIds,
            "notification"=>array(
                "body"=> $request->body,
                "title"=> $request->title,
                "icon"=> url('images/logo.png'),
                "click_action"=> route('home')
            )
        );

        $headers=array(
            'Authorization: key=AAAA0-tAPuo:APA91bFi54FlkX18cPTxSDzaTXUT5gI_BPSppB83eZcw1P2tF-vXMP092MhgHYAvF7_ep4Un78VHr5nLV0lKlhKiF1Oa-KZCXNfd3Az81fGDSbKzGfqzzN9KINyNc5t51pjbFr3fcsKT',
            'Content-Type:application/json'
        );

        $ch=curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_POST,true);
        curl_setopt($ch,CURLOPT_HTTPHEADER,$headers);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch,CURLOPT_POSTFIELDS,json_encode($fields));
        $result=curl_exec($ch);
//        print_r($result);
        curl_close($ch);

        return back()->with('message', 'Message sent');
    }
}
