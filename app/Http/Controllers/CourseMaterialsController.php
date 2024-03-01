<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\Course;
use App\Models\CourseMaterial;
use App\Models\CourseVideoComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class CourseMaterialsController extends Controller
{

    public function create($id, $chapter)
    {
        $course = Course::findOrFail($id);
        $data['course'] = $course;
        $data['chapter'] = Chapter::whereId($chapter)->where('course_id', $course->id)->firstOrFail();
        $data['page_title'] = 'Add Course Material';
        return view('backend.course_materials.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required',
            'chapter_id' => 'required',
            'title' => 'required',
            'file' => 'required|file'
        ]);

        $path = uniqid() . time() . '.mp4';

        $filePath = $request->file('file')->storeAs('course_materials', $path, 'public_path');
        $request->file('file')->storeAs('course_materials', $path, 'public');

        $material = new CourseMaterial();
        $material->title = $request->title;
        $material->chapter_id = $request->chapter_id;
        $material->course_id = $request->course_id;
        $material->description = $request->description;
        $material->link = url($filePath);
        $material->save();

        return back()->with('message', 'Material added');
    }

    public function uploadCourseMaterial(Request $request)
    {
        ignore_user_abort(true);
        $request->validate([
            'file' => 'required|file',
            'title' => 'required',
            'description' => 'required',
            'chapter' => 'required',
            'course' => 'required',
        ]);

        $file = $request->file('file');

        $path = $file->store('course_materials', env('DEFAULT_DISK'));

        $material = new CourseMaterial();
        $material->title = $request->title;
        $material->chapter_id = $request->chapter;
        $material->course_id = $request->course;
        $material->description = $request->description;
        $material->link = url($path);
        $material->save();

        return response(['status' => true], 200);
    }

    public function addVideoComment(Request $request)
    {
        $request->validate([
            'video' => 'required',
            'course' => 'required',
            'comment' => 'required'
        ]);

        $user = Session::get('user');

        $c = new CourseVideoComment();
        $c->course_id = $request->course;
        $c->video_id = $request->video;
        $c->comment = $request->comment;
        $c->picture = $user->image;
        $c->name = $user->name;
        $c->user_id = $user->id;
        $c->save();
        return response(['data' => $c], 200);
    }

    public function getVideoComments(Request $request)
    {
        $request->validate([
            'video' => 'required'
        ]);

        $comments = CourseVideoComment::where('video_id', $request->video)->get();

        return response(['data' => $comments], 200);
    }
}
