<?php

namespace App\Http\Controllers;

use App\Models\Campus;
use Illuminate\Http\Request;

class CampusController extends Controller
{
    //
    public function index()
    {
        $data['page_title'] = 'Campus Zones';
        $data['campus_menu'] = true;
        $data['camps'] = Campus::all();
        return view('backend.campus.index', $data);
    }


    public function edit($id)
    {
        $data['page_title'] = 'Edit Campus';
        $data['campus_menu'] = true;
        $data['camp'] = Campus::findOrFail($id);
        return view('backend.campus.edit', $data);
    }

    public function create()
    {
        $data['page_title'] = 'Create New Campus Zone';
        $data['campus_menu'] = true;
        return view('backend.campus.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'short_name' => 'required',

        ]);

        $p = new Campus();
        $p->name = $request->name;
        $p->short_name = $request->short_name;
        $p->save();


        return to_route('campus.index')->with('message', 'Campus added');
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'short_name' => 'required',

        ]);

        $p = Campus::findOrFail($id);
        $p->name = $request->name;
        $p->short_name = $request->short_name;
        $p->save();
        return to_route('campus.index')->with('message', 'Campus updated');
    }

    public function delete($id)
    {
        $p = Campus::findOrFail($id);

        $p->delete();
        return back()->with('message', 'campus deleted');

    }
}
