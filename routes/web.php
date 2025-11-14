<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LandlordController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;


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

// Route::get('/', function () {
//     return view('landing.master');
// });

Auth::routes(['verify' => true]);

Route::get('/', function () {
    // dd(Auth::user()->role);
    return view('user.profile');
});
Route::get('/', function () {
    return view('landing.master');
});


//Forgot Password
Route::get('/password/reset', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/password/email', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/password/reset/{token}', [App\Http\Controllers\Auth\ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [App\Http\Controllers\Auth\ResetPasswordController::class, 'reset'])->name('password.update');


// Route User
Route::middleware(['auth', 'user-role:user'])->group(function () {
    Route::get("/home", [StudentController::class, 'userindex'])->name("userindex");
    Route::get('/student/dashboard/search', [StudentController::class, 'searchDashboard'])->name('student.search');
    
    //Appt Details
    Route::get('/detail-appointment/{id}/{aptnum}', [StudentController::class, 'appointmentshow'])->name('userdetailAppointment.show');
    Route::get('/property-details/{propertyId}', [StudentController::class, 'viewPropertyDetails']);
    Route::post('/increment-views', [StudentController::class, 'incrementViews'])->name('increment.views');

    //profile
    Route::get("/profile", [StudentController::class, 'profile'])->name("profile");
    Route::get("/profile-setting", [StudentController::class, 'usersetting'])->name("usersetting");
    Route::put('/profile-setting/{id}', [StudentController::class, 'update'])->name('userprofile.update');
    Route::get("/profile-security", [StudentController::class, 'usersecurity'])->name("usersecurity");
    Route::put('/profile-security/password/{id}', [StudentController::class, 'userpassupdate'])->name('userpassupdate.update');
    Route::put('/profile-security/email/{id}', [StudentController::class, 'useremailupdate'])->name('useremailupdate.update');

});

// Route Landlord
Route::middleware(['auth', 'user-role:landlord'])->group(function () {
    Route::get("/landlord/home", [LandlordController::class, 'landlordHome'])->name("landlord.home");

    //new appt page
    Route::get("/landlord/newappt", [LandlordController::class, 'newapptdoc'])->name("newapptdoc");
    Route::get("/landlord/newappt/search", [LandlordController::class, 'searchnewapptdoc'])->name("searchnewapptdoc");

    //booking form page
    Route::get('/landlord/property-booking', [LandlordController::class, 'propertyBookingPage'])->name('landlord.property-booking');
    Route::post('/landlord/property-booking', [LandlordController::class, 'storePropertyBooking'])->name('landlord.store-property-booking');

    //status appt page
    Route::get("/landlord/appt-status-list", [LandlordController::class, 'statusList'])->name("landlord.statusList");
    Route::get("/landlord/appt-status-list/search", [LandlordController::class, 'searchStatusList'])->name("landlord.statusList.search");

    //approved appt page
    Route::get('landlord/approved-properties', [LandlordController::class, 'approveList'])->name('landlord.approveList');
    Route::get('landlord/search-approved-properties', [LandlordController::class, 'searchApproveList'])->name('landlord.searchApproveList');
    Route::get('landlord/approved-property/{id}', [LandlordController::class, 'approvePropertyDetails'])->name('landlord.approvePropertyDetails');


    //Cancel properties page
    Route::get('/landlord/cancel-properties', [LandlordController::class, 'cancelPropertyList'])->name('landlord.cancelPropertyList');
    Route::get('/landlord/search-cancelled-properties', [LandlordController::class, 'searchCancelledProperties'])->name('landlord.searchCancelledProperties');
    Route::get('/landlord/cancel-property/{id}', [LandlordController::class, 'cancelPropertyDetails'])->name('landlord.cancelPropertyDetails');

    //Resubmission properties page
    Route::get('/landlord/resubmit-list', [LandlordController::class, 'resubmitList'])->name('landlord.resubmitList');
    Route::get('/landlord/resubmit-property-details/{id}', [LandlordController::class, 'resubmitPropertyDetails'])->name('landlord.resubmitPropertyDetails');
    Route::get('/landlord/search-resubmit-list', [LandlordController::class, 'searchResubmitList'])->name('landlord.searchResubmitList');
    Route::get('/landlord/update-resubmission/{id}', [LandlordController::class, 'updateDetails'])->name('landlord.updateDetails');
    Route::put('/landlord/update-resubmission/{id}', [LandlordController::class, 'updateResubmission'])->name('landlord.updateResubmission');

    //All appt page
    Route::get("/landlord/allappt", [LandlordController::class, 'allapptdoc'])->name("allapptdoc");
    Route::get("/landlord/allappt/search", [LandlordController::class, 'searchallapptdoc'])->name("searchallapptdoc");

    //All student page
    Route::get("/landlord/studentlist", [LandlordController::class, 'studentlistdoc'])->name("studentlistdoc");
    Route::get("/landlord/studentlist/search", [LandlordController::class, 'searchstudentlistdoc'])->name("searchstudentlistdoc");

    //Appt Details
    Route::get('/landlord/detail-appointment/{id}/{aptnum}', [LandlordController::class, 'showPropertyDetails'])->name('detailAppointment.show');
    Route::put('/landlord/appointment/{id}', [LandlordController::class, 'update'])->name('appointment.update');
    Route::put('/landlord/appointment-report/{id}', [LandlordController::class, 'reportupdate'])->name('appointmentreport.update');
    Route::delete('/landlord/property/{id}', [LandlordController::class, 'deleteProperty'])->name('property.delete');
    Route::get('/landlord/property/{id}/{aptnum}', [LandlordController::class, 'showPropertyDetails'])->name('landlord.propertyDetails');

    //Profile
    Route::get("/landlord/profile", [LandlordController::class, 'profile'])->name("landlordprofile");
    Route::get("/landlord/profile-setting", [LandlordController::class, 'docsetting'])->name("docsetting");
    Route::put('/landlord/profile-setting/{id}', [LandlordController::class, 'docupdate'])->name('landlordprofile.update');
    Route::get("/landlord/profile-security", [LandlordController::class, 'docpass'])->name("docpass");
    Route::put('/landlord/profile-security/password/{id}', [LandlordController::class, 'docpassupdate'])->name('docpass.update');
    Route::put('/landlord/profile-security/email/{id}', [LandlordController::class, 'docpassemail'])->name('docemail.update');

    
});
// Route Admin
    Route::middleware(['auth', 'user-role:admin'])->group(function () {
    Route::get("/admin/home", [AdminController::class, 'index'])->name("admin.index");

    //new appt page
    Route::get("/admin/newappt", [AdminController::class, 'newapptdoc'])->name("admin.newapptdoc");
    Route::get("/admin/newappt/search", [AdminController::class, 'searchnewapptdoc'])->name("admin.searchnewapptdoc");

    //Approved properties page
    Route::get('/admin/approved-properties', [AdminController::class, 'approvedProperties'])->name('admin.approvedProperties');
    Route::get('/admin/search-approved-properties', [AdminController::class, 'searchApprovedProperties'])->name('admin.searchApprovedProperties');
    Route::get('/admin/approved/{id}/details', [AdminController::class, 'approveDetails'])->name('admin.approveDetails');

    //Cancel properties page
    Route::get('/admin/cancelled-properties', [AdminController::class, 'cancelledProperties'])->name('admin.cancelledProperties');
    Route::get('/admin/search-cancelled-properties', [AdminController::class, 'searchCancelledProperties'])->name('admin.searchCancelledProperties');
    Route::get('/admin/cancelled/{id}/details', [AdminController::class, 'cancelDetails'])->name('admin.cancelDetails');

    //Resubmission properties page
    Route::get('/admin/resubmit-properties', [AdminController::class, 'resubmitProperties'])->name('admin.resubmitProperties');
    Route::get('/admin/search-resubmit-properties', [AdminController::class, 'searchResubmitProperties'])->name('admin.searchResubmitProperties');
    Route::get('/admin/resubmit/{id}/details', [AdminController::class, 'resubmitDetails'])->name('admin.resubmitDetails');
    
    //All properties page
    Route::get("/admin/all-properties", [AdminController::class, 'allProperties'])->name("admin.allProperties");
    Route::get("/admin/all-properties/search", [AdminController::class, 'searchAllProperties'])->name("admin.searchAllProperties");

    //All student page
    Route::get("/admin/studentlist", [AdminController::class, 'studentlistdoc'])->name("admin.studentlistdoc");
    Route::get("/admin/studentlist/search", [AdminController::class, 'searchstudentlistdoc'])->name("admin.searchstudentlistdoc");

    //All Landlord page
    Route::get("/admin/landlordlist", [AdminController::class, 'landlordlist'])->name("admin.doclistdoc");
    Route::get("/admin/landlordlist/search", [AdminController::class, 'searchlandlordlist'])->name("admin.searchlandlordlist");

    //Appt Details
    Route::get('/admin/property-details/{id}', [AdminController::class, 'showPropertyDetails'])->name('admin.propertyDetails');
    Route::put('/admin/property-action/{id}', [AdminController::class, 'propertyAction'])->name('admin.propertyAction');
    Route::put('/admin/property-report/{id}', [AdminController::class, 'reportUpdate'])->name('admin.propertyReport');

    //Admin Profile
    Route::get("/admin/profile", [AdminController::class, 'profile'])->name("adminprofile");
    Route::get("/admin/profile-setting", [AdminController::class, 'adminsetting'])->name("adminsetting");
    Route::put('/admin/profile-setting/{id}', [AdminController::class, 'adminupdate'])->name('adminprofile.update');
    Route::get("/admin/profile-security", [AdminController::class, 'adminpass'])->name("adminpass");
    Route::put('/admin/profile-security/password/{id}', [AdminController::class, 'adminpassupdate'])->name('adminpass.update');

    //Doc Profile
    Route::get("/admin/landlord/profile/{id}", [AdminController::class, 'landlordprofile'])->name("adminlandlordprofile");
    Route::get("/admin/landlord/{id}/profile-setting", [AdminController::class, 'admindocsetting'])->name("admindocsetting");
    Route::put('/admin/landlord/profile-setting/{id}', [AdminController::class, 'admindocupdate'])->name('adminlandlordprofile.update');
    Route::get("/admin/landlord/{id}/profile-security", [AdminController::class, 'admindocpass'])->name("admindocpass");
    Route::put('/admin/landlord/profile-security/password/{id}', [AdminController::class, 'admindocpassupdate'])->name('admindocpass.update');
    Route::put('/admin/landlord/profile-security/email/{id}', [AdminController::class, 'admindocemail'])->name('admindocemail.update');

    //Add student
    Route::get("/admin/studentlist/new-student", [AdminController::class, 'newstudent'])->name("newstudent");
    Route::post('/admin/studentlist/new-student/register', [AdminController::class, 'storestudent'])->name("addstudent");

    //student Profile
    Route::get("/admin/student/profile/{id}", [AdminController::class, 'studentprofile'])->name("studentprofile");
    Route::get("/admin/student/{id}/profile-setting", [AdminController::class, 'studentsetting'])->name("studentsetting");
    Route::put('/admin/student/profile-setting/{id}', [AdminController::class, 'studentupdate'])->name('studentupdate.update');
    Route::get("/admin/student/{id}/profile-security", [AdminController::class, 'studentpass'])->name("studentpass");
    Route::put('/admin/student/profile-security/password/{id}', [AdminController::class, 'studentpassupdate'])->name('studentpassupdate.update');
    Route::put('/admin/student/profile-security/email/{id}', [AdminController::class, 'studentemailupdate'])->name('studentemailupdate.update');

    Route::delete('/admin/appointment/delete/{id}', [AdminController::class, 'apptdelete'])->name('apptdelete.delete');
    Route::delete('/admin/landlord/delete/{id}', [AdminController::class, 'landlorddelete'])->name('landlorddelete.delete');
    Route::delete('/admin/student/delete/{id}', [AdminController::class, 'studentdelete'])->name('studentdelete.delete');
});

