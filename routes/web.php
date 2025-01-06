<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\VerifyAcct;
use App\Http\Controllers\UserRegistrationController;
use App\Http\Controllers\DonorController;
use App\Http\Controllers\userLoginController;
use App\Http\Controllers\VolunteerController;


//  HOMEPAGE ROUTES:

//Homepage Route
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// About page route
Route::view('/about', 'homepage.about')->name('about');
// Donation (Donor) page route
Route::view('/more-donor', 'homepage.more_donor')->name('more_donor');
// Volunteer page route
Route::view('/more-volunteer', 'homepage.more_volunteer')->name('more_volunteer');
// More news page route
Route::get('/more-news/{id}', [App\Http\Controllers\HomeController::class, 'moreNews'])->name('more-news');
// Contact Us page route
Route::get('/contact', [InquiryController::class, 'index'])->name('contact');
Route::post('/contact/submit', [InquiryController::class, 'insert'])->name('inquiry.insert');

// Register select view page route
Route::get('/register', [UserRegistrationController::class, 'showRegistrationType'])->name('register');
Route::get('/register/donor', [UserRegistrationController::class, 'showDonorForm'])->name('donor.register');
Route::get('/register/volunteer', [UserRegistrationController::class, 'showVolunteerForm'])->name('vol.register');

// Register Submit route
Route::post('/register/donor', [UserRegistrationController::class, 'registerDonor'])->name('register.donor');
Route::post('/register/volunteer', [UserRegistrationController::class, 'registerVolunteer'])->name('register.vol');

//User login route
Route::post('/', [userLoginController::class, 'login'])->name('login');
Route::post('/logout', [userLoginController::class, 'logout'])->name('user.logout');




//ADMIN ROUTES:

// Admin Reset  Password Page
Route::get('/admin/login/reset_password', function () {
    return view('admin.admin_forgot');
})->name('admin.reset_password');

// Admin Find Email Page
Route::get('/admin/login/find_email', function () {
    return view('admin.admin_find_email');
})->name('admin.findEmail');

// Admin Login
Route::get('/admin/login', [App\Http\Controllers\AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [App\Http\Controllers\AdminController::class, 'login'])->name('admin.login.submit');
// Admin Logout
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

// Middleware-protected routes for admin
Route::middleware(['admin', 'prevent-back-button'])->prefix('admin')->group(function () {
    // Admin Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::get('/profile', [AdminController::class, 'admin_profile'])->name('admin.profile');
    Route::post('/admin/profile/{id}', [AdminController::class, 'updateProfile'])->name('admin.updateProfile');
    Route::post('/admin/account/{id}', [AdminController::class, 'updateAccount'])->name('admin.updateAccount');

    // Admin Inquiries
    Route::get('/inquiries', [InquiryController::class, 'inbox'])->name('admin.inquiries');
    Route::post('/inquiries/delete', [InquiryController::class, 'deleteSelected'])->name('inquiries.delete');
    Route::get('/inquiries/read/{id}', [InquiryController::class, 'inquiriesRead'])->name('inquiries.read');
    Route::get('/inquiries/reply/{id}', [InquiryController::class, 'reply'])->name('inquiries.reply');
    Route::post('/inquiry-sendreply', [InquiryController::class, 'sendReply'])->name('inquiries.sendReply');

    // Admin Verify
    Route::get('/verify_account/view_details/{id}', [VerifyAcct::class, 'viewDetails'])->name('view_details');
    Route::post('/verify_account/{id}', [VerifyAcct::class, 'processVerification'])->name('process_verification');
    Route::get('/verify_account', [VerifyAcct::class, 'showInactiveAccounts'])->name('verify_account');
    // Admin appointments
    Route::get('/appointments', [AdminController::class, 'showAppointments'])->name('admin.appointments');
    Route::post('/appointments/{id}', [VerifyAcct::class, 'create_appointment'])->name('create.appointment');
    Route::post('/appointments/{id}/delete', [AdminController::class, 'delete_appointment'])->name('appointments.delete');
    // Admin chapter
    Route::get('/chapters', [AdminController::class, 'chapters'])->name('admin.chapters');
    Route::post('/chapters', [AdminController::class, 'store'])->name('chapters.store');
    Route::post('/chapters/{id}/update', [AdminController::class, 'update'])->name('chapters.update');
    Route::post('/chapters/{id}/destroy', [AdminController::class, 'destroy'])->name('chapters.destroy');
});



// Middleware-protected routes for user
Route::middleware(['auth', 'prevent-back-button'])->prefix('user')->group(function () {

    // Middleware-protected routes for Donor
    Route::middleware('role:Donor')->prefix('donor')->group(function () {
        Route::get('/home', [DonorController::class, 'index'])->name('donor.home');
    });

    // Middleware-protected routes for Volunteer
    Route::middleware('role:Volunteer')->prefix('volunteer')->group(function () {
        Route::get('/home', [VolunteerController::class, 'index'])->name('volunteer.home');
    });
});


Route::get('/donor/prc-chapters', [DonorController::class, 'showChapters'])->name('prc-chapters');
