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

Route::get('MyProfile', [
    App\Http\Controllers\PageController::class,
    'MyProfile'
])->name('myprofile');

Route::controller(App\Http\Controllers\PageController::class)->group(
    function () {
        Route::post('Job/Post/Viewing', 'ViewJob')->name('viewItem');
        Route::get('register', 'registerpage')->name('register');


        Route::get('personal_data', 'personal_data')->name('employee.personal_data');
        Route::get('service_records', 'service_records')->name('employee.service_records');
        Route::get('daily_time_records', 'daily_time_records')->name('employee.daily_time_records');
        Route::get('leave_credits', 'leave_credits')->name('employee.leave_credits');
        Route::get('loan_transaction_records', 'loan_transaction_records')->name('employee.loan_transaction_records');
        Route::get('payslips', 'payslips')->name('employee.payslips');
        Route::get('overtime_records', 'overtime_records')->name('employee.overtime_records');
        Route::get('discipline_records', 'discipline_records')->name('employee.discipline_records');
        Route::get('leave_application', 'leave_application')->name('employee.leave_application');
        Route::get('compensatory_timeoff', 'compensatory_timeoff')->name('employee.compensatory_timeoff');
        Route::get('dtr_correction', 'dtr_correction')->name('employee.dtr_correction');
        Route::get('monetization', 'monetization')->name('employee.monetization');
        Route::get('official_business_pass', 'official_business_pass')->name('employee.official_business_pass');
        Route::get('clearance', 'clearance')->name('employee.clearance');
        Route::get('leave_benefits', 'leave_benefits')->name('employee.leave_benefits');
    }
);

Route::controller(App\Http\Controllers\AuthController::class)->group(
    function () {
        Route::get('/portal/login', 'index')->name('login');
        Route::post('login', 'signin')->name('signin');
        Route::post('logout', 'logout')->name('logout');
        Route::post('register', 'register')->name('register');
    }
);
Route::controller(App\Http\Controllers\DashboardController::class)->group(
    function () {
        Route::get('Admin/Dashboard', 'index')->name('admin.dashboard');
        Route::get('Dashboard', 'employee_Dashboard')->name('employee.dashboard');
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
        Route::post('fetch/Applications', 'Fetch');
        Route::post('update/applicantStatus', 'MarkApplicants');
        Route::post('application/setInterview', 'setInterview')->name('admin.setInterview');
        Route::post('set/Hired', 'SetasHired');
    }
);
Route::controller(App\Http\Controllers\AnnouncementController::class)->group(
    function () {
        Route::get('Announcement', 'index')->name('admin.announcements');
        Route::post('save/announcement', 'store')->name('save.announcement');
    }
);
Route::controller(App\Http\Controllers\ReportsController::class)->group(
    function () {
        Route::get('Reports', 'index')->name('admin.reports');
        Route::get('Generate', 'generate')->name('generate.page');
    }
);
Route::controller(App\Http\Controllers\UserController::class)->group(
    function () {
        Route::get('Users', 'index')->name('admin.users');
        Route::post('Add/Users', 'store')->name('admin.addusers');
        Route::post('Update/Users', 'update')->name('admin.updateusers');
        Route::post('fetch/Users', 'Fetch');
        Route::post('lock/users', 'lock');
        Route::post('forceaccount', 'changepassV')->name('admin.forcecpvchangepass');
    }
);
Route::controller(App\Http\Controllers\AuditLogController::class)->group(
    function () {
        Route::get('AuditLogs', 'index')->name('admin.auditlogs');
    }
);

Route::controller(App\Http\Controllers\EmployeeController::class)->group(
    function () {
        Route::post('cancel', 'cancel')->name('cancel.Request');
        Route::post('cancel_CT', 'cancelct')->name('cancel.Requestct');
        Route::post('cancelDtrc', 'cancelDTR')->name('cancel.Requestdtr');
        Route::post('cancelmone', 'cancelmone')->name('cancel.Requestmone');
        Route::post('cancelobpass', 'cancelobpass')->name('cancel.Requestob');
        Route::post('save', 'save_leave_app')->name('save.leaveapplication');
        Route::get('viewing/LeaveDates', 'viewLeavedates')->name('View.Dates');
        Route::post('save/compensatory', 'savenewcompensatorytimeoff')->name('save.newcompensatorytimeoff');
        Route::post('save/dtrCorrections', 'savedtrCorrections')->name('save.dtrCorrections');
        Route::post('save/monetization', 'savedNewmonetization')->name('save.newmonetization');
        Route::post('save/obpass', 'savenewobpass')->name('save.newobpass');
        Route::post('save/clearance', 'saveclearance')->name('save.newclearance');
        Route::post('updateProfile', 'updateProfile')->name('update.profile');
        Route::post('cancelClearance', 'cancelClearance')->name('cancel.Requestclearance');
    }
);











Route::get('/home', [
    App\Http\Controllers\HomeController::class,
    'index',
])->name('home');

Route::controller(App\Http\Controllers\MailController::class)->group(
    function () {
        Route::get('remind', 'Resend_Interviewnotice')->name('mail.sendInterview');
        Route::post('resend/invitation', 'Resend_Interviewnotice');
        Route::post('resend/acknowledgement', 'Resend_Acknowledgement');
    }
);

Route::get('/testemail', [App\Http\Controllers\MailController::class, 'testemail']);
Route::get('/viewmail', function () {
    return view('mail');
});
Route::any('/{page?}', function () {
    return view('404.404');
})->where('page', '.*');
