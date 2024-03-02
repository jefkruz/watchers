<?php

use App\Http\Controllers\CampusController;
use App\Http\Controllers\MagazineController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\ZoneController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SlidesController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\ChaptersController;
use App\Http\Controllers\CourseMaterialsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ChatsController;
use App\Http\Controllers\MeetingsController;
use App\Http\Controllers\ResourcesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WebNotificationsController;
use App\Http\Controllers\MainController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('auth/v1/register/confirm/{username}/{code}', [AuthController::class, 'verifyRegistration'])->name('verifyRegistration');
Route::get('auth/v2/reset/password/{username}/{code}', [AuthController::class, 'showResetPassword'])->name('showResetPassword');
Route::post('auth/v2/password/{username}/{code}', [AuthController::class, 'resetPassword'])->name('resetPassword');
Route::get('global-directories', [HomeController::class, 'globalDirectories'])->name('globalDirectories');
Route::get('login', [AuthController::class, 'showLogin'])->name('login');
Route::post('login', [AuthController::class, 'login']);


Route::get('forgot/password', [AuthController::class, 'showForgotPassword'])->name('password.reset');
Route::post('forgot/password', [AuthController::class, 'forgotPassword'])->name('password.email');

Route::get('register', [AuthController::class, 'showRegister'])->name('register');
Route::get('register/{username}', [AuthController::class, 'showRegister'])->name('referralRegister');

Route::get('signin', [AuthController::class, 'showSignIn'])->name('signIn');
Route::get('signin/{username}', [AuthController::class, 'showSignIn'])->name('referralSignIn');
Route::get('download/magazine/{username}', [HomeController::class, 'downloadMagazine'])->name('mag');

Route::post('signin', [AuthController::class, 'signIn']);
Route::post('register', [AuthController::class, 'register']);
Route::post('register/{username}', [AuthController::class, 'register']);
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('auth/login', [AuthController::class, 'showAdminLogin'])->name('adminLogin');
Route::post('auth/login', [AuthController::class, 'adminLogin']);

//ZONAL  REGISTRATION ROUTES
Route::get('{zone}/register',  [AuthController::class, 'showZoneRegister'])->name('zoneRegister');
Route::post('{zone}/register',  [AuthController::class, 'register']);
//CAMPUS  REGISTRATION ROUTES
Route::get('{campus}/register',  [AuthController::class, 'showCampusRegister'])->name('campusRegister');
Route::post('{campus}/register',  [AuthController::class, 'register']);

//CAMPUS SIGN IN ROUTES
Route::get('{campus}/signin',  [AuthController::class, 'showCampusSignIn'])->name('campusSignin');
Route::post('{campus}/signin',  [AuthController::class, 'signin']);

//ZONAL SIGN IN ROUTES
Route::get('{zone}/signup',  [AuthController::class, 'showZoneSignIn'])->name('zoneSignin');
Route::post('{zone}/signup',  [AuthController::class, 'signin']);



Route::group(['prefix' => 'ajax'], function(){
    Route::get('chats', [ChatsController::class, 'fetchChats'])->name('fetchChats');
    Route::post('chats', [ChatsController::class, 'addChat'])->name('addChat');
    Route::post('courses/purchase/free', [CoursesController::class, 'purchaseFreeCourse'])->name('purchaseFreeCourse');
    Route::post('course/payment/initialize', [CoursesController::class, 'initializeCoursePayment'])->name('initializeCoursePayment');
    Route::post('meeting/attendance', [MeetingsController::class, 'markAttendance'])->name('markAttendance');
    Route::post('meeting/guest/attendance', [MeetingsController::class, 'markGuestAttendance'])->name('markGuestAttendance');
    Route::get('notifications/new', [WebNotificationsController::class, 'checkForNew'])->name('checkForNew');
    Route::post('courses/video/comments', [CourseMaterialsController::class, 'addVideoComment'])->name('addVideoComment');
    Route::get('courses/video/comments', [CourseMaterialsController::class, 'getVideoComments'])->name('getVideoComments');

});

Route::group(['middleware' => 'isGuest'], function() {
    Route::get('index', [MainController::class, 'index'])->name('guest');
    Route::get('programmes', [MeetingsController::class, 'showMeetings'])->name('guestMeetings');
    Route::get('programme/view/{code}', [MeetingsController::class, 'attendGuestMeeting'])->name('attendGuestsMeeting');

//TESTIMONY ROUTES
    Route::get('testimonies', [MainController::class, 'guestTestimony'])->name('guestTestimony');
    Route::post('testimony', [MainController::class, 'submitGuestTestimony']);


//PRAYER REQUEST ROUTES
    Route::get('prayer/requests', [MainController::class, 'guestPrayerRequest'])->name('guestPrayer');
    Route::post('prayer-request', [MainController::class, 'submitGuestPrayer']);

});

Route::group(['middleware' => 'isLoggedIn'], function() {
    Route::post('firebase/token', [WebNotificationsController::class, 'saveFirebaseToken'])->name('saveToken');

    Route::get('/', [HomeController::class, 'index']);
    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::get('notifications', [HomeController::class, 'notifications'])->name('notifications');
    Route::post('save/token', [HomeController::class, 'saveToken'])->name('saveToken');
//    Route::get('information', [ResourcesController::class, 'info'])->name('info');
    Route::get('posts', [ResourcesController::class, 'showResources'])->name('showResources');
    Route::get('post/view/{id}/{slug}', [ResourcesController::class, 'viewResource'])->name('viewResource');
    Route::post('post/view/{id}/{slug}', [ResourcesController::class, 'addComment']);
    Route::get('magazine', [HomeController::class, 'magazine'])->name('magazine');
    Route::get('programmes', [MeetingsController::class, 'showMeetings'])->name('meetings');
    Route::get('programme/watch/{code}', [MeetingsController::class, 'attendMeeting'])->name('attendMeeting');
    Route::get('trainings/view/{id}', [CoursesController::class, 'viewCourse'])->name('viewCourse');
    Route::get('trainings/preview/{id}', [CoursesController::class, 'previewCourse'])->name('previewCourse');
    Route::get('trainings/payment/verify/{id}', [CoursesController::class, 'verifyCoursePayment'])->name('verifyCoursePayment');
    Route::get('download/magazine/{username}', [HomeController::class, 'downloadMagazine'])->name('mag');
    Route::get('profile', [HomeController::class, 'profile'])->name('profile');
    Route::patch('profile', [HomeController::class, 'updateProfile'])->name('updateProfile');
    Route::get('referral', [HomeController::class, 'referrals'])->name('referrals');
    Route::get('participants', [HomeController::class, 'participants'])->name('participants');
    Route::get('downloads/count', [HomeController::class, 'downloadCount'])->name('downloadsCount');
    Route::get('referral/{username}', [HomeController::class, 'viewreferral'])->name('view');
    Route::get('trainings/trending', [CoursesController::class, 'trendingCourses'])->name('trendingCourses');
    Route::get('trainings/general', [CoursesController::class, 'generalCourses'])->name('generalCourses');
    Route::get('trainings/subscription', [CoursesController::class, 'subscriptionCourses'])->name('subscriptionCourses');
    Route::get('trainings/certification', [CoursesController::class, 'certificationCourses'])->name('certificationCourses');
    Route::get('trainings/family/{id}', [CoursesController::class, 'familyCourses'])->name('familyCourses');
    Route::get('trainings/family/{id}/{type}', [CoursesController::class, 'familyCoursesByType'])->name('familyCoursesByType');
    Route::get('trainings/me', [CoursesController::class, 'myCourses'])->name('myCourses');
    Route::get('notifications', [WebNotificationsController::class, 'notifications'])->name('notifications');
    Route::get('notification/view/{id}', [WebNotificationsController::class, 'viewNotification'])->name('viewNotification');

//SOUL ROUTES
    Route::get('soul/{username}', [MainController::class, 'showSoul']);
    Route::post('soul/{username}', [MainController::class, 'soul']);

//TESTIMONY ROUTES
    Route::get('testimony', [HomeController::class, 'testimony'])->name('testimony');
    Route::post('testimony', [HomeController::class, 'submitTestimony']);


//PRAYER REQUEST ROUTES
    Route::get('prayer-request', [HomeController::class, 'prayerRequest'])->name('prayer');
    Route::post('prayer-request', [HomeController::class, 'submitPrayer']);

});


Route::group(['middleware' => 'isAdmin', 'prefix' => 'pilot'], function(){
    Route::get('/', [DashboardController::class, 'adminDashboard'])->name('adminDashboard');
    Route::get('push-notification', [DashboardController::class, 'pushNotification'])->name('adminNotification');

    Route::post('notification', [WebNotificationsController::class, 'sendFirebaseNotification'])->name('sendNotification');


    Route::group(['prefix' => 'zones'], function(){
        Route::get('/', [ZoneController::class, 'index'])->name('zone.index');
        Route::post('/', [ZoneController::class, 'store'])->name('zone.store');
        Route::get('create', [ZoneController::class, 'create'])->name('zone.create');
        Route::get('edit/{id}', [ZoneController::class, 'edit'])->name('zone.edit');
        Route::patch('update/{id}', [ZoneController::class, 'update'])->name('zone.update');
        Route::delete('{id}', [ZoneController::class, 'delete'])->name('zone.delete');
    });

    Route::group(['prefix' => 'campus'], function(){
        Route::get('/', [CampusController::class, 'index'])->name('campus.index');
        Route::post('/', [CampusController::class, 'store'])->name('campus.store');
        Route::get('create', [CampusController::class, 'create'])->name('campus.create');
        Route::get('edit/{id}', [CampusController::class, 'edit'])->name('campus.edit');
        Route::patch('update/{id}', [CampusController::class, 'update'])->name('campus.update');
        Route::delete('{id}', [CampusController::class, 'delete'])->name('campus.delete');

    });


    Route::group(['prefix' => 'influencers'], function(){
        Route::get('/', [UserController::class, 'allStaff'])->name('staff.index');
        Route::get('all', [UserController::class, 'allStaffProfile'])->name('staff.allProfile');
        Route::get('view/{id}', [UserController::class, 'viewUser'])->name('user.show');

        Route::get('birthdays', [UserController::class, 'birthdays'])->name('birthdays');
        Route::put('team_head/{id}', [UserController::class, 'setAsTeamHead'])->name('user.setTeamHead');
        Route::post('team_head/delete/{id}', [UserController::class, 'deleteHead'])->name('user.deleteHead');
        Route::post('team_head/bulk-delete', [UserController::class, 'bulkDelete'])->name('user.bulkDelete');

    });

    Route::group(['prefix' => 'participants'], function(){
        Route::get('/', [UserController::class, 'allGuest'])->name('guests.index');
    });
    Route::group(['prefix' => 'programmes'], function(){
        Route::get('/', [MeetingsController::class, 'index'])->name('meetings.index');
        Route::get('manage/{id}', [MeetingsController::class, 'manage'])->name('meetings.manage');
        Route::post('/', [MeetingsController::class, 'store'])->name('meetings.store');
        Route::post('delete/{id}', [MeetingsController::class, 'destroy'])->name('meetings.delete');
    });

    Route::group(['prefix' => 'slides'], function(){
        Route::get('/', [SlidesController::class, 'index'])->name('slides.index');
        Route::post('/', [SlidesController::class, 'store'])->name('slides.store');
        Route::delete('{id}', [SlidesController::class, 'delete'])->name('slides.delete');
    });

    Route::group(['prefix' => 'magazine'], function(){
        Route::get('/', [MagazineController::class, 'index'])->name('magazines.index');
        Route::post('/', [MagazineController::class, 'store'])->name('magazines.store');
        Route::delete('{id}', [MagazineController::class, 'delete'])->name('magazines.delete');
    });

    Route::group(['prefix' => 'trainings'], function(){
        Route::get('/', [CoursesController::class, 'index'])->name('courses.index');
        Route::post('/', [CoursesController::class, 'store'])->name('courses.store');
        Route::get('create', [CoursesController::class, 'create'])->name('courses.create');
        Route::patch('update/{id}', [CoursesController::class, 'update'])->name('courses.update');
        Route::post('delete/{id}', [CoursesController::class, 'destroy'])->name('courses.delete');
        Route::get('show/{id}', [CoursesController::class, 'show'])->name('courses.show');
        Route::patch('activate/{id}', [CoursesController::class, 'activateCourse'])->name('courses.activate');
    });

    Route::group(['prefix' => 'chapters'], function(){
        Route::post('/', [ChaptersController::class, 'store'])->name('chapters.store');
        Route::post('delete/{id}', [ChaptersController::class, 'destroy'])->name('chapters.delete');
    });

    Route::group(['prefix' => 'coursematerials'], function(){
        Route::post('/', [CourseMaterialsController::class, 'store'])->name('coursematerials.store');
        Route::get('create/{id}/{chapter}', [CourseMaterialsController::class, 'create'])->name('coursematerials.create');
    });

    Route::group(['prefix' => 'team_heads'], function(){
        Route::get('/', [UserController::class, 'teamHeads'])->name('user.teamHeads');
    });

    Route::group(['prefix' => 'ajax'], function(){
        Route::get('material', [CourseMaterialsController::class, 'fetchMaterialDetail'])->name('ajaxFetchMaterial');
        Route::post('materials', [CourseMaterialsController::class, 'uploadCourseMaterial'])->name('ajaxUploadMaterial');
        Route::patch('chapters/arrangement/{id}', [CoursesController::class, 'saveChapterArrangement'])->name('ajaxSaveChapterArrangement');
    });



    Route::group(['prefix' => 'posts'], function(){
        Route::get('/', [ResourcesController::class, 'index'])->name('resources.index');
        Route::post('/', [ResourcesController::class, 'store'])->name('resources.store');
        Route::get('create', [ResourcesController::class, 'create'])->name('resources.create');
        Route::get('edit/{id}', [ResourcesController::class, 'edit'])->name('resources.edit');
        Route::patch('update/{id}', [ResourcesController::class, 'update'])->name('resources.update');
        Route::delete('{id}', [ResourcesController::class, 'delete'])->name('resources.delete');
    });

    Route::group(['prefix' => 'videos'], function(){
        Route::get('/', [VideoController::class, 'index'])->name('videos.index');
        Route::post('/', [VideoController::class, 'store'])->name('videos.store');
        Route::get('create', [VideoController::class, 'create'])->name('videos.create');
        Route::get('edit/{id}', [VideoController::class, 'edit'])->name('videos.edit');
        Route::post('delete/{id}', [VideoController::class, 'destroy'])->name('videos.delete');
        Route::patch('update/{id}', [VideoController::class, 'update'])->name('videos.update');
    });



});
