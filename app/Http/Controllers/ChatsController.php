<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ChatsController extends Controller
{
    public function fetchChats(Request $request)
    {
        $request->validate([
            'meeting' => 'required'
        ]);

        $msgs = Chat::where('meeting_id', $request->meeting)->get();
        foreach($msgs as $msg){
            $msg->timeAdded = date('g:i A', strtotime($msg->created_at));
        }

        return response(['data' => $msgs], 200);
    }

    public function addChat(Request $request)
    {



        $request->validate([
            'meeting' => 'required',
            'message' => 'required'
        ]);

        $user = Session::get('user');

        $msg = new Chat();
        $msg->meeting_id = $request->meeting;
        $msg->user_id = $user->id;
        $msg->username = $user->username;
        $msg->image = $user->image;
        $msg->name = $user->name;
        $msg->message = $request->message;
        $msg->save();

        $msg->timeAdded = date('g:i A', strtotime($msg->created_at));

        return response(['data' => $msg], 200);
    }
}
