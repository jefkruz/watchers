<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\Course;
use Illuminate\Http\Request;

class ChaptersController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required',
            'name' => 'required'
        ]);

        $exists = Chapter::whereName($request->name)->where('course_id', $request->course_id)->exists();
        if($exists){
            return back()->with('error', 'Chapter exists already');
        }

        $course = Course::findOrFail($request->course_id);

        $ch = new Chapter();
        $ch->course_id = $course->id;
        $ch->name = $request->name;
        $ch->save();

        $p = ($course->chapter_ids == null || $course->chapter_ids == '') ? [] : explode(",", $course->chapter_ids);
        array_push($p, $ch->id);
        $course->chapter_ids = implode(",", $p);
        $course->save();

        return back()->with('message', 'Chapter added');
    }
    public function destroy($id)
    {
        //
        $doc = Chapter::findOrFail($id);

        $doc->delete();

        return redirect()->back()->with('message', 'Chapter Deleted');
    }
}
