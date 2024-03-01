<?php

namespace App\Http\Controllers;

use App\Models\Zone;
use Illuminate\Http\Request;

class ZoneController extends Controller
{
    //

    public function index()
    {
        $data['page_title'] = 'Church Zones';
        $data['zone_menu'] = true;
        $data['zones'] = Zone::all();
        return view('backend.zone.index', $data);
    }


    public function edit($id)
    {
        $data['page_title'] = 'Edit Zone';
        $data['zone_menu'] = true;
        $data['zone'] = Zone::findOrFail($id);
        return view('backend.zone.edit', $data);
    }

    public function create()
    {
        $data['page_title'] = 'Create New Church Zone';
        $data['zone_menu'] = true;
        return view('backend.zone.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'short_name' => 'required',

        ]);

        $p = new Zone();
        $p->name = $request->name;
        $p->short_name = $request->short_name;
        $p->save();


        return to_route('zone.index')->with('message', 'Zone added');
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'short_name' => 'required',

        ]);

        $p = Zone::findOrFail($id);
        $p->name = $request->name;
        $p->short_name = $request->short_name;
        $p->save();
        return to_route('zone.index')->with('message', 'Zone Updated');
    }

    public function delete($id)
    {
        $p = Zone::findOrFail($id);

        $p->delete();
        return back()->with('message', 'Zone deleted');

    }
}
