<?php

namespace App\Http\Controllers;

use App\Models\TeamHead;
use App\Models\Director;
use App\Models\Feedback;

use App\Models\Participant;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;

class UserController extends Controller
{


    public function allStaff()
    {
        $data['page_title'] = 'All Influencers';
        $data['members'] = User::all();
        $data['staff_menu'] = true;
        return view('backend.staff.index', $data);
    }


    public function allGuest()
    {
        $data['page_title'] = 'All Participants';
        $data['members'] = Participant::all();
        $data['guest_menu'] = true;
        return view('backend.staff.guests', $data);
    }

    public function allStaffProfile()
    {
        $data['page_title'] = 'Staff Members Profile';
        $data['members'] = User::whereNotNull('kc_username')->get();
        $data['staff_menu'] = true;
        return view('backend.staff.all', $data);
    }



    public function showStaffMembers()
    {
        $user = Session::get('user');
        if(!$user->isDirector()){
            return back();
        }
        $data['notifications'] = WebNotificationsController::fetchLatestNotifications();
        $data['page_title'] = 'Staff Members';
        $data['members'] = User::all();
        $data['staff_menu'] = true;
        return view('staff_members', $data);
    }


    public function viewUser($id)
    {
        $staff = User::findOrFail($id);
        $head = TeamHead::where('user_id', $staff->id)->first();
//        $director = Director::where('department_id', $staff->department_id)->first();
        $data['isTeamHead'] = $staff->isTeamHead();
        $data['page_title'] = 'View Staff Member';
        $data['member'] = $staff;
        $data['teamHead'] = $head;
        $data['staff_menu'] = true;
        return view('backend.staff.show', $data);
    }

    public function setAsTeamHead($id)
    {
        $user = User::findOrFail($id);
//        $head = DepartmentHead::where('department_id', $staff->department_id)->first();
//        if(!$head){
            $head = new TeamHead();
//        }
        $head->user_id = $user->id;
        $head->save();
        return back()->with('message', 'Influencer has been added as Team head');
    }


    public function teamHeads()
    {
        $data['page_title'] = 'Team Heads';
        $data['members'] = TeamHead::all();
        $data['leader_menu'] = true;
        return view('backend.staff.dept_heads', $data);
    }


    public function updateProfile(Request $request)
    {
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'family_id' => 'required',
            'age_range' => 'required',
            'phone' => 'required',
            'role_id' => 'required',
            'birth_date' => 'required',
            'birth_month' => 'required',
            'nok' => 'required',
            'nok_phone' => 'required',
            'residential_address' => 'required',
            'office_address' => 'required',
            'ministry_awards' => 'array', // Ensure it's an array
            'ministry_awards.*' => 'present|string', // Each item should be a string or null
            'employment_date' => 'required',
            'qualifications' => 'array',
            'qualifications.*' => 'present|string',
            'university' => 'required'
        ],
        [
            'ministry_awards.*.present' => 'Each item in the ministry awards field must be present.',
            'ministry_awards.*.string' => 'Each item in the ministry awards field must be filled.',
            'qualifications.*.present' => 'Each item in the ministry awards field must be present.',
            'qualifications.*.string' => 'Each item in the ministry awards field must be filled.',

        ]);

        if (!$request->has('ministry_awards')) {
            $request->merge(['ministry_awards' => [null]]);
        }
        if (!$request->has('qualifications')) {
            $request->merge(['qualifications' => [null]]);
        }

//        return $request;


        $staff = Session::get('user');
        $user = User::find($staff->id);
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->family_id = $request->family_id;
        $user->age_range = $request->age_range;
        $user->birth_date = $request->birth_date;
        $user->birth_month = $request->birth_month;
        $user->anniversary = $request->anniversary;
        $user->nok = $request->nok;
        $user->nok_phone = $request->nok_phone;
        $user->residential_address = $request->residential_address;
        $user->office_address = $request->office_address;
        $user->children = $request->children;
        $user->kc_username = $request->kc_username;
        $user->ministry_awards =json_encode($request->ministry_awards);
        $user->phone = $request->phone;
        $user->role_id = $request->role_id;
        $user->employment_date = $request->employment_date;
        $user->qualifications = json_encode($request->qualifications);
        $user->university = $request->university;
        $user->profile_updated = true;
        $user->save();

        session()->put('user', $user);
        return back()->with('message', 'Profile updated');
    }

    public function birthdays()
    {
        $data['page_title'] = ' Birthdays';
        $data['i'] = 1;
        $data['birthday_menu'] = true;
        $month = date('n');
        $data['members'] = User::where('birth_month',$month)->get();
        return view('backend.staff.birthdays',$data);
    }


    public function feedback()
    {
        $data['notifications'] = WebNotificationsController::fetchLatestNotifications();
        $staff = Session::get('user');
        $data['page_title'] = 'Feedback Form';
        $data['staff'] = $staff;
        $data['feedback_menu'] = true;
        return view('feedback', $data);
    }

    public function submitFeedback(Request $request)
    {
        $request->validate([
            'staff_id' => 'required',
            'title' => 'required',
            'feedback' => 'required',

        ]);
        $feedback = new Feedback();
        $feedback->staff_id = $request->staff_id;
        $feedback->title = $request->title;
        $feedback->feedback = $request->feedback;
        $feedback->save();
        return back()->with('message', 'Feedback Submitted');
    }



    public function deleteHead($id)
    {
        $doc = TeamHead::findOrFail($id);

        $doc->delete();

        return redirect()->back()->with('message', 'Team Leader Deleted');
    }

    public function bulkDelete()
    {

        TeamHead::truncate();

        return redirect()->back()->with('message', 'All  Team Leaders records have been deleted.');
    }



}
