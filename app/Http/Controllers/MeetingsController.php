<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Models\MeetingAttendance;
use App\Models\Stream;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MeetingsController extends Controller
{
    public function index()
    {
        $programmes = Meeting::latest()->get();
        foreach($programmes as $programme){
            $programme->startSeconds = strtotime($programme->start_date);
            $programme->endSeconds = strtotime($programme->end_date);
        }
        $data['page_title'] = 'Live Programmes';
        $data['programmes'] = $programmes;
        $data['meet_menu'] = true;
        $data['streams'] = Stream::all();
        return view('backend.meetings.index', $data);
    }

    public function manage($id)
    {
        $data['viewers'] = MeetingAttendance::where('meeting_id',$id)->get();
        $data['meet_menu'] = true;
        $title = Meeting::where('id',$id)->value('title');
        $data['page_title'] = $title . ' Attendance Records';
        return view('backend.meetings.manage', $data);
    }

    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'file' => 'required|mimes:jpeg,png,pdf,doc,docx,jpg,gif,svg|max:5048',
            'accessibility' => 'required',
            'stream_link' => 'required',
            'start_date' => 'required',
            'end_date' => 'required'
        ]);



        $filePath = $request->file('file')->store('meetings', env('DEFAULT_DISK'));


        $ev = new Meeting();
        $ev->title = $request->title;
        $ev->image = $filePath;
        $ev->accessibility = $request->accessibility;
        $ev->stream_link = $request->stream_link;
        $ev->start_date = date("Y-m-d H:i:s", ($request->start_date / 1000));
        $ev->end_date = date("Y-m-d H:i:s", ($request->end_date / 1000));
        $ev->unique_code = 'YLWSIN-' . time();
        $ev->save();

        $n = new WebNotificationsController();
        $n->createNotification($ev->title, 'programme', $ev->id);

        return back()->with('message', 'Programme created');

    }

    public function showMeetings()
    {
        $isHead = session('user')->isTeamHead();
        $programmes = Meeting::where('end_date', '>=', date('Y-m-d H:i:s'))->ofType($isHead)->latest()->get();
        foreach($programmes as $programme){
            $programme->startSeconds = strtotime($programme->start_date);
        }
        $data['notifications'] = WebNotificationsController::fetchLatestNotifications();
        $data['page_title'] = 'Live Programmes';
        $data['meet_menu'] = true;
        $data['meetings'] = $programmes;
        return view('influencers.meetings', $data);
    }

    public function markAttendance(Request $request)
    {
        $request->validate([
            'meeting' => 'required'
        ]);

        $user = Session::get('user');
        $att = MeetingAttendance::where('meeting_id', $request->meeting)->where('user_id', $user->id)->first();

        if(!$att){
            $att = new MeetingAttendance();
            $att->user_id = $user->id;
            $att->role_id = '1';
            $att->meeting_id = $request->meeting;
            $att->save();
        }

        return response(['status' => true], 200);
    }

    public function markGuestAttendance(Request $request)
    {
        $request->validate([
            'meeting' => 'required'
        ]);

        $user = Session::get('guest');
        $att = MeetingAttendance::where('meeting_id', $request->meeting)->where('user_id', $user->id)->first();

        if(!$att){
            $att = new MeetingAttendance();
            $att->user_id = $user->id;
            $att->role_id = '2';
            $att->meeting_id = $request->meeting;
            $att->save();
        }

        return response(['status' => true], 200);
    }

    public function attendMeeting($code)
    {
        $data['notifications'] = WebNotificationsController::fetchLatestNotifications();
        $meeting = Meeting::where('unique_code', $code)->firstOrFail();
        if(!$meeting->isLive()){
            return back();
        }

        $data['page_title'] = 'Now Live: ' . $meeting->title;
        $data['meeting'] = $meeting;
        $data['meet_menu'] = true;
        return view('influencers.watch_meeting', $data);
    }

    public function attendGuestMeeting($code)
    {

        $meeting = Meeting::where('unique_code', $code)->firstOrFail();
        if(!$meeting->isLive()){
            return back();
        }

        $data['page_title'] = 'Now Live: ' . $meeting->title;
        $data['meeting'] = $meeting;
        $data['meet_menu'] = true;
        return view('guests.watch_meeting', $data);
    }
    public function destroy($id)
    {
        //
        $doc = Meeting::findOrFail($id);

        $doc->delete();

        return redirect()->back()->with('message', 'Meeting Deleted');
    }
}
