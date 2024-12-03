<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\UserRegistrationController;


// Homepage route
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// About page route
Route::view('/about', 'homepage.about')->name('about');
// Donation (Donor) page route
Route::view('/more-donor', 'homepage.more_donor')->name('more_donor');
// Recipient page route
Route::view('/more-recipient', 'homepage.more_recipient')->name('more_recipient');
// Volunteer page route
Route::view('/more-volunteer', 'homepage.more_volunteer')->name('more_volunteer');

// More news page route
Route::get('/more-news/{id}', [App\Http\Controllers\HomeController::class, 'moreNews'])->name('more-news');


// Contact Us page route
Route::get('/contact', [App\Http\Controllers\InquiryController::class, 'index'])->name('contact');
Route::post('/contact/submit', [App\Http\Controllers\InquiryController::class, 'insert'])->name('inquiry.insert');

// Register select view page route
Route::get('/register', [UserRegistrationController::class, 'showRegistrationType'])->name('register');

Route::get('/register/donor', [UserRegistrationController::class, 'showDonorForm'])->name('donor.register');
Route::get('/register/donee', [UserRegistrationController::class, 'showDoneeForm'])->name('donee.register');
Route::get('/register/volunteer', [UserRegistrationController::class, 'showVolunteerForm'])->name('vol.register');


Route::post('/register/donor', [UserRegistrationController::class, 'registerDonor'])->name('register.donor');
Route::post('/register/donee', [UserRegistrationController::class, 'registerDonee'])->name('register.donee');
Route::post('/register/volunteer', [UserRegistrationController::class, 'registerVolunteer'])->name('register.vol');


// Admin Forgot Page
Route::get('/admin/login/reset_password', function () {
    return view('admin.admin_forgot');
})->name('admin.reset_password');


// Admin Forgot Page
Route::get('/admin/login/find_email', function () {
    return view('admin.admin_find_email');
})->name('admin.findEmail');

Route::get('/admin/login', [App\Http\Controllers\AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [App\Http\Controllers\AdminController::class, 'login'])->name('admin.login.submit');

Route::middleware('admin')->prefix('admin')->group(function () {
    // Admin Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Admin Inquiries
    Route::get('/inquiries', [InquiryController::class, 'inbox'])->name('admin.inquiries');
    Route::post('/inquiries/delete', [InquiryController::class, 'deleteSelected'])->name('inquiries.delete');
    Route::get('/inquiries/read/{id}', [InquiryController::class, 'inquiriesRead'])->name('inquiries.read');
    Route::get('/inquiries/reply/{id}', [InquiryController::class, 'reply'])->name('inquiries.reply');
    Route::post('/inquiry-sendreply', [InquiryController::class, 'sendReply'])->name('inquiries.sendReply');
});


// Admin Logout
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
