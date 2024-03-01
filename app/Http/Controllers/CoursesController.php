<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseAttendance;
use App\Models\CourseMaterial;
use App\Models\CourseVideoComment;
use App\Models\JobFamily;
use App\Models\PurchasedCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CoursesController extends Controller
{
    public function index()
    {
        $data['page_title'] = 'Courses';
        $data['courses_menu'] = true;
        $data['courses'] = Course::all();
        return view('backend.courses.index', $data);
    }

    public function create()
    {
        $data['page_title'] = 'Create Course';
        $data['courses_menu'] = true;
        return view('backend.courses.create', $data);
    }

    public function show($id)
    {
        $data['page_title'] = 'View Course';
        $data['courses_menu'] = true;
        $data['course'] = Course::findOrFail($id);
        return view('backend.courses.show', $data);
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        $course = Course::findOrFail($id);
        if($request->hasFile('thumbnail')){
            $file = $request->file('thumbnail');

            $path = $file->store('course_thumbnails', env('DEFAULT_DISK'));
            $course->thumbnail = $path;
        }
        $course->title = $request->title;
        $course->description = $request->description;
        $course->save();
        return back()->with('message', 'Course updated');
    }

    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'course_type' => 'required',
            'category' => 'required',
            'thumbnail' => 'required|file',
            'accessibility' => 'required'
        ]);


        if($request->course_type == 'subscription' || $request->course_type == 'certification'){
            $request->validate([
                'course_fee_naira' => 'required',
                'course_fee_dollar' => 'required',
            ]);
        }

        $file = $request->file('thumbnail');

        $path = $file->store('course_thumbnails', env('DEFAULT_DISK'));

        $course = new Course();
        $course->title = $request->title;
        $course->description = $request->description;
        $course->accessibility = $request->accessibility;
        $course->thumbnail = $path;
        $course->category = $request->category;
        $course->course_type = $request->course_type;
        $course->course_fee_naira = $request->course_fee_naira;
        $course->course_fee_dollar = $request->course_fee_dollar;
        $course->save();



        return to_route('courses.show', $course->id)->with('message', 'Course created');
    }

    public function destroy($id)
    {
        //
        $doc = Course::findOrFail($id);

        $doc->delete();

         return to_route('courses.index')->with('message', 'Course Deleted');
    }

    public function search(Request $request)
    {
        $request->validate([
            'q' => 'required'
        ]);

        $videos = CourseMaterial::where('title', 'like', '%' . $request->q . '%')->orWhere('description', 'like', '%' . $request->q . '%')->get();
        $data['page_title'] = 'Searching for: ' . $request->q;
        $data['notifications'] = WebNotificationsController::fetchLatestNotifications();
        $data['videos'] = $videos;
        return view('search', $data);

    }

    public function saveChapterArrangement($id, Request $request)
    {
        $request->validate([
            'item' => 'required'
        ]);

        $course = Course::findOrFail($id);
        $course->chapter_ids = implode(",", $request->item);
        $course->save();

        return response(['status' => true], 200);
    }

    public function activateCourse($id)
    {
        $course = Course::whereIdAndStatus($id, 'inactive')->firstOrFail();
        $course->status = 'active';
        $course->save();

        $n = new WebNotificationsController();
        $n->createNotification($course->title, 'course', $course->id);

        return back()->with('message', 'Course has been activated');
    }

    public function myCourses()
    {
        $data['page_title'] = 'My Courses';
        $data['my_course_menu'] = true;
        $purchases = PurchasedCourse::where('user_id', Session::get('user')->id)->whereStatus('complete')->get();
        $ids = [];
        foreach($purchases as $purchase){
            array_push($ids, $purchase->course_id);
        }
        $data['courses'] = Course::whereIn('id', $ids)->get();
        return $this->showCourses($data);
    }

    public function familyCourses($id)
    {
        $fam = JobFamily::findOrFail($id);
        $data['notifications'] = WebNotificationsController::fetchLatestNotifications();
        $data['page_title'] = $fam->name . ' Courses';
        $data['family'] = $fam;
        return view('family_course_categories', $data);
    }

    public function familyCoursesByType($id, $category)
    {
        $accepted = ['free', 'subscription', 'certification'];
        if(!in_array($category, $accepted)){
            return back();
        }
        $fam = JobFamily::findOrFail($id);
        $isAdmin = session('user')->isDepartmentHead();
        $data['page_title'] = ucfirst($category). ' Courses :: ' . $fam->name . ' Job Family';
        $data['courses'] = Course::whereStatus('active')->where('family_id', $fam->id)->where('course_type', $category)->ofType($isAdmin)->latest()->get();
        return $this->showCourses($data);
    }

    public function trendingCourses()
    {

        $data['page_title'] = 'Trending Courses';
        $data['courses'] = Course::whereStatus('active')->latest()->get();
        return $this->showCourses($data);
    }

    public function generalCourses()
    {
        $isHead = session('user')->isTeamHead();
        $data['page_title'] = 'General Courses';
        $data['courses'] = Course::whereStatusAndCategory('active', 'general')->ofType($isHead)->latest()->get();
        return $this->showCourses($data);
    }

    public function subscriptionCourses()
    {
        $isHead = session('user')->isTeamHead();
        $data['page_title'] = 'Subscription Courses';
        $data['courses'] = Course::whereStatus('active')->where('course_type', 'subscription')->ofType($isHead)->latest()->get();
        return $this->showCourses($data);
    }

    public function certificationCourses()
    {
        $isHead = session('user')->isTeamHead();
        $data['page_title'] = 'Certification Courses';
        $data['courses'] = Course::whereStatus('active')->where('course_type', 'certification')->ofType($isHead)->latest()->get();
        return $this->showCourses($data);
    }

    private function showCourses($data)
    {
        $data['notifications'] = WebNotificationsController::fetchLatestNotifications();
        return view('influencers.show_courses', $data);
    }

    public function viewCourse($id)
    {
        $isHead = session('user')->isTeamHead();
        $user = Session::get('user');
        $course = Course::ofType($isHead)->whereId($id)->firstOrFail();
        if(!$course->purchased()){
            return to_route('previewCourse', $id);
        }
        $firstVideo = $course->chapters()[0]->materials()[0] ?? null;
        $comments = ($firstVideo) ? CourseVideoComment::where('video_id', $firstVideo->id)->get() : [];
        $attExists = CourseAttendance::where('course_id', $course->id)->where('user_id', $user->id)->exists();
        if(!$attExists){
            $att = new CourseAttendance();
            $att->course_id = $course->id;
            $att->user_id = $user->id;
            $att->save();
        }
        $data['notifications'] = WebNotificationsController::fetchLatestNotifications();
        $data['course'] = $course;
        $data['page_title'] = 'View Course';
        $data['first_video'] =  $firstVideo;
        $data['comments'] = $comments;
        $data['views'] = CourseAttendance::where('course_id', $course->id)->count();
        return view('influencers.view_course', $data);
    }

    public function previewCourse($id)
    {
        $isHead = session('user')->isTeamHead();
        $course = Course::ofType($isHead)->whereId($id)->firstOrFail();
        if($course->purchased()){
            return to_route('viewCourse', $id);
        }
        $data['notifications'] = WebNotificationsController::fetchLatestNotifications();
        $data['course'] = $course;
        $data['page_title'] = 'Preview Course';
        return view('influencers.preview_course', $data);
    }

    public function purchaseFreeCourse(Request $request)
    {
        $request->validate([
            'course' => 'required'
        ]);
        $course = Course::findOrFail($request->course);
        if($course->course_type != 'free'){
            return response(['message' => 'This is not a free course'], 400);
        }

        $user = Session::get('user');
        $exists = PurchasedCourse::where('user_id', $user->id)->where('course_id', $course->id)->exists();
        if(!$exists){
            $pay = new PurchasedCourse();
            $pay->course_id = $course->id;
            $pay->user_id = $user->id;
            $pay->type = 'free';
            $pay->status = 'complete';
            $pay->save();
        }
        return response(['status' => true], 200);
    }

    public function initializeCoursePayment(Request $request)
    {
        $request->validate([
            'currency' => 'required',
            'amount' => 'required',
            'course' => 'required'
        ]);

        $course = Course::findOrFail($request->course);
        if($course->course_type == 'free'){
            return response(['message' => 'This is a free course'], 400);
        }
        if($request->currency == 'USD'){
            if($request->amount != $course->course_fee_dollar){
                return response(['message' => 'Forbidden'], 400);
            }
            $paymentType = 'international';
        } else {
            if($request->amount != $course->course_fee_naira){
                return response(['message' => 'Forbidden'], 400);
            }
            $paymentType = 'nigerian';
        }

        $callbackUrl = route('verifyCoursePayment', $course->id);

        $user = Session::get('user');

        $curl = curl_init();

        $description = 'Payment for YLWSIN Course: ' . $course->title;

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.kingspay-gs.com/api/payment/initialize',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{
                "amount": '. $request->amount * 100 .',
                "currency": "' . $request->currency . '",
                "description": "' . $description. '",
                "merchant_callback_url": "' . $callbackUrl . '",
                "metadata": {
                    "name": "'. $user->title . ' ' . $user->firstname . ' ' . $user->lsatname .'",
                    "email": "' . $user->email . '"
                },
                "payment_type": "' . $paymentType . '"
                }',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . env('KINGSPAY_KEY'),
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $resp = json_decode($response, true);

        if(array_key_exists('payment_id', $resp)){
            $paymentID = $resp['payment_id'];
            $purchase = PurchasedCourse::where('user_id', $user->id)->where('course_id', $course->id)->whereType('paid')->first();

            if(!$purchase){
                $purchase = new PurchasedCourse();
                $purchase->user_id = $user->id;
                $purchase->course_id = $course->id;
                $purchase->type = 'paid';
            }

            $purchase->description = $description;
            $purchase->currency = $request->currency;
            $purchase->amount = $request->amount;
            $purchase->payment_id = $paymentID;
            $purchase->save();
            return response(['data' => 'https://kingspay-gs.com/payment?id=' . $paymentID], 200);
        } else {
            return response(['message' => 'Unable to initialize payment'], 400);
        }
    }

    public function verifyCoursePayment($id)
    {
        $user = Session::get('user');
        $course = Course::findOrFail($id);
        $purchase = PurchasedCourse::where('course_id', $course->id)->where('user_id', $user->id)->whereType('paid')->firstOrFail();

        $paymentID = $purchase->payment_id;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.kingspay-gs.com/api/payment/' . $paymentID,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $resp = json_decode($response);

        $amount = 0;

        if($purchase->currency == 'USD'){
            $amount = $course->course_fee_dollar;
        }
        if($purchase->currency == 'NGN'){
            $amount = $course->course_fee_naira;
        }

        if($amount != $purchase->amount){
            return to_route('previewCourse', $course->id)->with('error', 'Inconsistent amount detected');
        }

        if($purchase->amount == ($resp->amount / 100) && $resp->status == 'SUCCESS'){
            $purchase->status = 'complete';
            $purchase->save();
            return to_route('viewCourse', $course->id)->with('message', 'Payment successful');
        } else {
            return to_route('previewCourse', $course->id)->with('error', 'Unable to make payment. Please try again.');
        }

    }
}
