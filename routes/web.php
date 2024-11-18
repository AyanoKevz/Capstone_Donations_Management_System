<?php

use Illuminate\Support\Facades\Route;

// Homepage route
Route::get('/', function () {
    return view('homepage.index');
})->name('home');

// About page route
Route::get('/about', function () {
    return view('homepage.about');
})->name('about');

// Donation (Donor) page route
Route::get('/more-donor', function () {
    return view('homepage.more_donor');
})->name('more_donor');

// Recipient page route
Route::get('/more-recipient', function () {
    return view('homepage.more_recipient');
})->name('more_recipient');

// Volunteer page route
Route::get('/more-volunteer', function () {
    return view('homepage.more_volunteer');
})->name('more_volunteer');

// Contact Us page route
Route::get('/contact', function () {
    return view('homepage.contact');
})->name('contact');

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
