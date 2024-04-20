<?php

namespace App\Http\Controllers;


use App\Models\Video;
use App\Models\VideoComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class VideoController extends Controller
{
    //
    public function index()
    {
        $data['page_title'] = 'Videos';
        $data['video_menu'] = true;
        $data['videos'] = Video::latest()->get();
        return view('backend.videos.index', $data);
    }

    public function create()
    {
        $data['page_title'] = 'Upload Videos';
        $data['video_menu'] = true;
        return view('backend.videos.create', $data);
    }

    public function edit($id)
    {
        $data['blog'] = Video::findOrFail($id);
        $data['page_title'] = 'Edit Video';
        $data['video_menu'] = true;
        return view('backend.videos.edit', $data);
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'title' => 'required',
            'status' => 'required'
        ]);
        Video::where('status', 'active')->update(['status' => 'Inactive']);
        $post = Video::findOrFail($id);

        $post->name = $request->title;
        $post->status = $request->status;
        $post->save();

        return to_route('videos.index')->with('message', 'Video updated');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'video' => 'required|file|mimes:mp4,mov',
        ], [
            'title.required' => 'The title field is required.',
            'video.required' => 'The video field is required.',
            'video.file' => 'The video must be a file.',
            'video.mimes' => 'The video must be either an MP4 or MOV file.',
        ]);

        Video::where('status', 'active')->update(['status' => 'Inactive']);
        $video = new Video();
        $video->name = $request->title;
        $video->description = $request->description;
        $video->slug = Str::slug($request->title);
        $video->status ='active';


        $file = $request->file('video');

        $filePath = $file->store('video', env('DEFAULT_DISK'));
        $video->link = $filePath;

        $video->save();

        return to_route('videos.index')->with('message', 'Video Uploaded');
    }


    public function viewVideo($id, $slug)
    {
        $data['notifications'] = WebNotificationsController::fetchLatestNotifications();
        $video = Video::whereIdAndSlug($id, $slug)->firstOrFail();

        $data['page_title'] = $video->name;

        $data['video'] = $video;
        return view('influencers.watch_video', $data);
    }

    public function showVideos()
    {
        $data['notifications'] = WebNotificationsController::fetchLatestNotifications();
        $data['page_title'] = 'Videos';
        $data['videos'] = Video::latest('created_at')->get();
        return view('influencers.videos', $data);
    }

    public function viewDocumentary($id, $slug)
    {
        $video = Video::whereIdAndSlug($id, $slug)->firstOrFail();

        $data['page_title'] = $video->name;

        $data['video'] = $video;
        return view('influencers.watch_documentary', $data);
    }

    public function showDocumentary()
    {
        $data['page_title'] = 'Videos';
        $data['videos'] = Video::latest('created_at')->get();
        return view('influencers.documentary', $data);
    }

    public function addComment($id, $slug, Request $request)
    {
        $request->validate([
            'comment' => 'required'
        ]);
        $video = Video::whereIdAndSlug($id, $slug)->firstOrFail();
        $user = Session::get('user');

        $comment = new VideoComment();
        $comment->video_id = $video->id;
        $comment->user_id = $user->id;
        $comment->name = $user->name;
        $comment->picture = $user->image;
        $comment->comment = $request->comment;
        $comment->save();

        return back();
    }

    public function destroy($id)
    {
        //
        $doc = Video::findOrFail($id);

        $doc->delete();

        return redirect()->back()->with('message', 'Video Deleted');
    }
}
