<?php

namespace App\Http\Controllers;

use App\Models\ResourceComment;
use App\Models\ResourcePost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class ResourcesController extends Controller
{
    public function index()
    {
        $data['page_title'] = 'Posts';
        $data['resource_menu'] = true;
        $data['resources'] = ResourcePost::latest()->get();
        return view('backend.resources.index', $data);
    }

    public function showResources()
    {
        $isHead = session('user')->isTeamHead();
        $data['notifications'] = WebNotificationsController::fetchLatestNotifications();
        $data['page_title'] = 'Information Center';
        $data['resource_menu'] = true;
        $data['resources'] = ResourcePost::ofType($isHead)->latest()->get();
        return view('influencers.resources', $data);
    }

    public function viewResource($id, $slug)
    {
        $resource = ResourcePost::whereIdAndSlug($id, $slug)->firstOrFail();
        $data['notifications'] = WebNotificationsController::fetchLatestNotifications();
        $data['resource'] = $resource;
        $data['page_title'] = $resource->title;
        $data['resource_menu'] = true;
        return view('influencers.view_resource', $data);
    }

    public function addComment($id, $slug, Request $request)
    {
        $request->validate([
            'comment' => ['required', 'regex:/^[^<>]*$/'], // Disallow '<' and '>' characters
        ], [
            'comment.regex' => 'The comment must not contain HTML or script tags.'
        ]);
        $post = ResourcePost::whereIdAndSlug($id, $slug)->firstOrFail();
        $user = Session::get('user');

        $comment = new ResourceComment();
        $comment->resource_id = $post->id;
        $comment->user_id = $user->id;
        $comment->name = $user->name;
        $comment->picture = $user->image;
        $comment->comment = $request->comment;
        $comment->save();

        return back();
    }

    public function edit($id)
    {
        $data['page_title'] = 'Edit Post';
        $data['resource_menu'] = true;
        $data['res'] = ResourcePost::findOrFail($id);
        return view('backend.resources.edit', $data);
    }

    public function create()
    {
        $data['page_title'] = 'Create New Post';
        $data['resource_menu'] = true;
        return view('backend.resources.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'accessibility' => 'required',
            'post_body' => 'required'
        ]);

        $path = null;
        if($request->hasFile('file')){
            $file = $request->file('file');
            $path = $file->store('resource_center', env('DEFAULT_DISK'));
        }

        $p = new ResourcePost();
        $p->title = $request->title;
        $p->accessibility = $request->accessibility;
        $p->slug = Str::slug($request->title);
        $p->content = $request->post_body;
        $p->image = $path;
        $p->save();


        $n = new WebNotificationsController();
        $n->createNotification($p->title, 'post', $p->id,$p->slug);


        return to_route('resources.index')->with('message', 'Post added');
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'title' => 'required',
            'accessibility' => 'required',
            'post_body' => 'required'
        ]);

        $p = ResourcePost::findOrFail($id);
        $path = $p->image;
        if($request->hasFile('file')){
            $file = $request->file('file');
            $path = $file->store('resource_center', env('DEFAULT_DISK'));
        }


        $p->title = $request->title;
        $p->accessibility = $request->accessibility;
        $p->content = $request->post_body;
        $p->image = $path;
        $p->save();


        return to_route('resources.index')->with('message', 'Post updated');
    }

    public function delete($id)
    {
        $p = ResourcePost::findOrFail($id);
        foreach($p->comments() as $comment){
            $comment->delete();
        }
        $p->delete();
        return back()->with('message', 'Post deleted');

    }
}
