<?php

use Illuminate\Support\Facades\Route;



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

/* Route::get('/more-news', function () {
    return view('homepage.more_news');
})->name('more-news'); */

// Contact Us page route
Route::get('/contact', [App\Http\Controllers\InquiryController::class, 'index'])->name('contact');
Route::post('/contact/submit', [App\Http\Controllers\InquiryController::class, 'insert'])->name('inquiry.insert');

// Register Us page route
Route::get('/register', function () {
    return view('homepage.register');
})->name('register');

// Donor Registration Page
Route::get('/register/donor', function () {
    return view('homepage.donor_r');
})->name('register.donor');

// Donee Registration Page
Route::get('/register/donee', function () {
    return view('homepage.donee_r');
})->name('register.donee');

// Volunteer Registration Page
Route::get('/register/volunteer', function () {
    return view('homepage.volunteer_r');
})->name('register.volunteer');

// Admin Login Page
Route::get('/admin/login', function () {
    return view('admin.admin_login');
})->name('admin.login');

// Admin Forgot Page
Route::get('/admin/login/forgot', function () {
    return view('admin.admin_forgot');
})->name('admin.forgot');

// Admin Dashboard Page
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

// Admin Dashboard Page
Route::get('/admin/email', function () {
    return view('admin.admin_forgot_email');
})->name('admin.email');

// Admin Dashboard Page
Route::get('/admin/inquiries', function () {
    return view('admin.inquiries');
})->name('admin.inquiries');
