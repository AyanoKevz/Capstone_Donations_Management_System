<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\VerifyAcct;
use App\Http\Controllers\UserRegistrationController;
use App\Http\Controllers\DonorController;
use App\Http\Controllers\userLoginController;
use App\Http\Controllers\VolunteerController;
use App\Http\Controllers\user_profileController;


//  HOMEPAGE ROUTES:

//Homepage Route
Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('prevent-back-button');
// About page route
Route::view('/about', 'homepage.about')->name('about');
// Donation (Donor) page route
Route::view('/more-donor', 'homepage.more_donor')->name('more_donor');
// Volunteer page route
Route::view('/more-volunteer', 'homepage.more_volunteer')->name('more_volunteer');
// More news page route
Route::get('/more-news/{id}', [HomeController::class, 'moreNews'])->name('more-news');
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
Route::post('/user-login', [userLoginController::class, 'login'])->name('login');
Route::post('/logout', [userLoginController::class, 'logout'])->name('user.logout');

Route::post('/forgot-password', [HomeController::class, 'sendResetLink'])->name('forgot-password');
Route::get('/reset-password/{token}', [HomeController::class, 'showResetForm'])->name('reset-password');
Route::post('/reset-password', [HomeController::class, 'resetPassword'])->name('reset-password.submit');



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

    // Admin Profile
    Route::get('/profile', [AdminController::class, 'admin_profile'])->name('admin.profile');
    Route::post('/profile/{id}', [AdminController::class, 'updateProfile'])->name('admin.updateProfile');
    Route::post('/account/{id}', [AdminController::class, 'updateAccount'])->name('admin.updateAccount');
    //Manage Admin
    Route::get('/active-admin', [AdminController::class, 'adminList'])->name('admin.list');
    Route::post('/Admin-create', [AdminController::class, 'CreateAdmin'])->name('admin.store');
    Route::post('/Admin-delete', [AdminController::class, 'deleteAdmin'])->name('admin.delete');

    // Admin Donor List
    Route::get('/active-donors', [AdminController::class, 'allDonors'])->name('admin.donorList');
    Route::post('/active-donors/{userId}', [AdminController::class, 'deleteDonor'])->name('donors.delete');
    // Admin Volunteer List
    Route::get('/active-volunteer', [AdminController::class, 'allVolunteers'])->name('admin.volunteerList');
    Route::post('/volunteers/delete/{id}', [AdminController::class, 'deleteVolunteer'])->name('volunteers.delete');

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
    Route::post('/chapters', [AdminController::class, 'CreateChapter'])->name('chapters.store');
    Route::post('/chapters/{id}/update', [AdminController::class, 'update'])->name('chapters.update');
    Route::post('/chapters/{id}/destroy', [AdminController::class, 'destroy'])->name('chapters.destroy');
    // Admin News
    Route::get('/admin/news', [AdminController::class, 'showNews'])->name('admin.news');
    Route::post('/admin/news', [AdminController::class, 'CreateNews'])->name('news.create');
    Route::get('/admin/news/form', [AdminController::class, 'NewsForm'])->name('admin.news.form');
    Route::get('/admin/news/form/{id}', [AdminController::class, 'EditNewsForm'])->name('admin.news.form.edit');
    Route::post('/admin/news/update/{id}', [AdminController::class, 'UpdateNews'])->name('admin.news.update');

    Route::post('/admin/news/delete', [AdminController::class, 'deleteNews'])->name('news.delete');
});



// Middleware-protected routes for user
Route::middleware(['auth', 'prevent-back-button'])->prefix('user')->group(function () {

    Route::post('/user/account/{id}', [user_profileController::class, 'updateUserAccount'])->name('user.updateAccount');
    Route::post('/contact/send', [DonorController::class, 'UserContact'])->name('user.submit_contact');
    Route::post('/testimonials/store', [DonorController::class, 'StoreTestimonials'])->name('testimonials.store');
    Route::put('/testimonials/{id}/update', [DonorController::class, 'updateTestimonial'])->name('testimonials.update');
    Route::post('/testimonial/delete/{id}', [DonorController::class, 'deleteTestimonial'])->name('testimonial.delete');

    // Middleware-protected routes for Donor
    Route::middleware('role:Donor')->prefix('donor')->group(function () {
        Route::get('/home', [DonorController::class, 'index'])->name('donor.home');
        Route::get('/donor-profile', [user_profileController::class, 'DonorProfile'])->name('donor.profile');
        Route::post('/donor/update/{id}', [user_profileController::class, 'updateDonorProfile'])->name('donor.updateProfile');
        Route::get('/prc-chapters', [DonorController::class, 'showChapters'])->name('prc-chapters');
        Route::get('/contact', [DonorController::class, 'showContactForm'])->name('donor.contact_form');
        Route::get('/testimonial', [DonorController::class, 'showTestimonialForm'])->name('donor.testi_form');
        Route::get('/causes', [DonorController::class, 'causes'])->name('causes');
    });


    // Middleware-protected routes for Volunteer
    Route::middleware('role:Volunteer')->prefix('volunteer')->group(function () {
        Route::get('/home', [VolunteerController::class, 'index'])->name('volunteer.home');
        Route::get('/volunteer-profile', [user_profileController::class, 'VolunteerProfile'])->name('volunteer.profile');
        Route::post('/volunteer/update/{id}', [user_profileController::class, 'updateVolunteerProfile'])->name('volunteer.updateProfile');
    });
});
