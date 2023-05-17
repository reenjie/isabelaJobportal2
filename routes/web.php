<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect()->route('login');
});

// Route::get('/search',[
//     App\Http\Controllers\OtherControllers::class,
//     'index',
// ])->name('search');



Route::controller(App\Http\Controllers\PageController::class)->group(
    function () {
        Route::post('Job/Post/Viewing', 'ViewJob')->name('viewItem');
        Route::get('register', 'registerpage')->name('register');
      
    }
);

Route::controller(App\Http\Controllers\AuthController::class)->group(
    function () {
        Route::get('/portal/login', 'index')->name('login');
        Route::post('login', 'signin')->name('signin');
        Route::post('logout', 'logout')->name('logout');
        Route::post('register','register')->name('register');
    }
);
Route::controller(App\Http\Controllers\DashboardController::class)->group(
    function () {
        Route::get('Dashboard', 'index')->name('admin.dashboard');
    }
);
Route::controller(App\Http\Controllers\JobPostingController::class)->group(
    function () {
        Route::get('JobPostings', 'index')->name('admin.jobpostings');
        Route::post('savepost', 'store')->name('save.jobpost');
        Route::post('edit.jobpost', 'edit')->name('edit.jobpost');
        Route::post('publish/jobposts', 'publish');
        Route::post('fetch/Jobposts', 'Fetch');
    }
);
Route::controller(App\Http\Controllers\JobApplicationController::class)->group(
    function () {
        Route::get('JobApplication', 'index')->name('admin.jobapplications');
        Route::post('fetch/Applications','Fetch');
        Route::post('update/applicantStatus','MarkApplicants');
        Route::post('application/setInterview','setInterview')->name('admin.setInterview');
    }
);
Route::controller(App\Http\Controllers\AnnouncementController::class)->group(
    function () {
        Route::get('Announcement', 'index')->name('admin.announcements');
        Route::post('save','store')->name('save.announcement');
    }
);
Route::controller(App\Http\Controllers\ReportsController::class)->group(
    function () {
        Route::get('Reports', 'index')->name('admin.reports');
    }
);
Route::controller(App\Http\Controllers\UserController::class)->group(
    function () {
        Route::get('Users', 'index')->name('admin.users');
        Route::post('Add/Users','store')->name('admin.addusers');
        Route::post('Update/Users','update')->name('admin.updateusers');
        Route::post('fetch/Users','Fetch');
        Route::post('lock/users','lock');

    }
);
Route::controller(App\Http\Controllers\AuditLogController::class)->group(
    function () {
        Route::get('AuditLogs', 'index')->name('admin.auditlogs');
    }
);
Route::get('/home', [
    App\Http\Controllers\HomeController::class,
    'index',
])->name('home');

Route::any('/{page?}', function () {
    return view('404.404');
})->where('page', '.*');
