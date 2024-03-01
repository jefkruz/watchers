<?php

namespace App\Http\Controllers;

use App\Models\Magazine;
use Illuminate\Http\Request;

class MagazineController extends Controller
{
    //
    public function index()
    {
        $data['page_title'] = 'Magazines';
        $data['slides_menu'] = true;
        $data['magazines'] = Magazine::all();
        return view('backend.magazines.index', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'month' => 'required',
            'image' => 'required',
            'file' => 'required|file|mimes:pdf'
        ]);

        $filePath = $request->file('file')->store('magazines', env('DEFAULT_DISK'));
        $imagePath = $request->file('image')->store('magazine_cover', env('DEFAULT_DISK'));

        Magazine::where('status', 'active')->update(['status' => 'Inactive']);
        $s = new Magazine();
        $s->image = $imagePath;
        $s->file = $filePath;
        $s->name = $request->name;
        $s->month = $request->month;
        $s->status = 'active';
        $s->save();

        return back()->with('message', 'Magazine added');
    }

    public function delete($id)
    {
        $s = Magazine::findOrFail($id);
        $s->delete();
        return back()->with('message', 'Magazine deleted');
    }
}
