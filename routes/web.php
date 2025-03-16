<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\VerifyAcct;
use App\Http\Controllers\UserRegistrationController;
use App\Http\Controllers\DonorController;
use App\Http\Controllers\userLoginController;
use App\Http\Controllers\VolunteerController;
use App\Http\Controllers\user_profileController;
use App\Http\Controllers\PayMongoController;


//  HOMEPAGE ROUTES:

//Homepage Route
Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('prevent-back-button');
Route::view('/install', 'install')->name('install');
Route::view('/thankyou-install', 'ty')->name('thankyou-message');
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

Route::get('mobile/login', [userLoginController::class, 'mobileLoginForm'])->name('mobile-login')->middleware('prevent-back-button');
Route::post('mobile/login', [userLoginController::class, 'SubmitMobileLogin'])->name('mlogin-submit');

Route::post('/logout', [userLoginController::class, 'logout'])->name('user.logout');

Route::post('/forgot-password', [HomeController::class, 'sendResetLink'])->name('forgot-password');
Route::get('/reset-password/{token}', [HomeController::class, 'showResetForm'])->name('reset-password');
Route::post('/reset-password', [HomeController::class, 'resetPassword'])->name('reset-password.submit');



//ADMIN ROUTES:

Route::get('/admin/login/find_email', [AdminController::class, 'showFindEmailForm'])->name('admin.findEmail');
Route::post('/admin/login/send_reset_link', [AdminController::class, 'sendResetLink'])->name('admin.sendResetLink');
Route::get('/admin/login/reset_password/{token}', [AdminController::class, 'showResetForm'])->name('admin.resetPasswordForm');
Route::post('/admin/login/reset_password', [AdminController::class, 'resetPassword'])->name('admin.resetPassword');

// Admin Login
Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.submit');
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

    // Request
    Route::get('donation/request', [DonationController::class, 'RequestForm'])->name('admin.request_form');
    Route::post('donation/submit-item-request', [DonationController::class, 'submitItemRequest'])->name('admin.request.submit');
    Route::post('donation/submit-cash-request', [DonationController::class, 'submitCashRequest'])->name('submit.cash.request');


    //Manage Admin
    Route::get('/active-admin', [AdminController::class, 'adminList'])->name('admin.list');
    Route::post('/Admin-create', [AdminController::class, 'CreateAdmin'])->name('admin.store');
    Route::post('/Admin-delete', [AdminController::class, 'deleteAdmin'])->name('admin.delete');

    // Admin Donor List
    Route::get('/active-donors', [AdminController::class, 'allDonors'])->name('admin.donorList');
    Route::post('/active-donors/{userId}', [AdminController::class, 'deleteDonor'])->name('donors.delete');
    Route::post('/donors/deactivate/{userId}', [AdminController::class, 'deactivateDonor'])->name('donors.deactivate');
    // Admin Volunteer List
    Route::get('/active-volunteer', [AdminController::class, 'allVolunteers'])->name('admin.volunteerList');
    Route::post('/volunteers/deactivate/{userId}', [AdminController::class, 'deactivateVolunteer'])->name('volunteers.deactivate');

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

    // Request List
    Route::get('/Request-List', [AdminController::class, 'allRequest'])->name('admin.requestList');
    Route::get('/request-details/{id}/{type}', [AdminController::class, 'requestDetails'])->name('request_details');


    //Donation Details
    // Route for Cash Donation Details
    Route::get('/cash-donation/{id}', [AdminController::class, 'showCashDonationDetails'])
        ->name('cash.donation.details');

    // Route for In-Kind Donation Details
    Route::get('/inkind-donation/{id}', [AdminController::class, 'showInKindDonationDetails'])
        ->name('inkind.donation.details');
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
        Route::view('quick/select-donations', 'users.donor.quick')->name('donor.quick_donation');
        Route::get('quick/In-Kind', [DonorController::class, 'quickInKindForm'])->name('quick.inKindForm');
        Route::get('quick/cash', [DonorController::class, 'quickcashForm'])->name('quick.cashForm');
        Route::post('/quick-in-kind-donate', [DonationController::class, 'quickInKindDonate'])->name('quickInKindDonate');
        Route::get('/testimonial', [DonorController::class, 'showTestimonialForm'])->name('donor.testi_form');
        Route::get('/learn-about-causes', [DonorController::class, 'causes'])->name('donor.causes');

        Route::get('/request/in-kind', [DonorController::class, 'requestInKind'])->name('donor.requestInKind');

        Route::get('/request-map/items', [DonationController::class, 'RequestMapInKind'])->name('donor.request_map');
        Route::post('/request-map/donate', [DonationController::class, 'RequestMapInKindDonate'])->name('donation.store');
        Route::get('/request-map/cash', [DonationController::class, 'RequestMapCash'])->name('donor.reqCash_map');
        Route::post('/donate/paymongo', [PayMongoController::class, 'createCheckout'])->name('paymongoMap.checkout');
        Route::get('/donate/paymongo/success', [PayMongoController::class, 'handleSuccess'])->name('paymongoMap.success');
        Route::get('/donate/paymongo/cancel', [PayMongoController::class, 'handleCancel'])->name('paymongoMap.cancel');
        Route::post('/dropoff-donation', [DonationController::class, 'MapDropOffDonateCash'])->name('dropoffMap.donation');

        Route::post('/quick-donation/paymongo', [PayMongoController::class, 'quickPayMongo'])->name('quickCash.paymongo');
        Route::post('/quick-donation/dropoff', [DonationController::class, 'quickDropOff'])->name('quickCash.dropoff');
        Route::get('/quick-donation/cash/success', [PayMongoController::class, 'quickPayMongoSuccess'])->name('quickCash.success');
        Route::get('/quick-donation/cash/cancel', [PayMongoController::class, 'quickPayMongoCancel'])->name('quickCash.cancel');
    });


    // Middleware-protected routes for Volunteer
    Route::middleware('role:Volunteer')->prefix('volunteer')->group(function () {
        Route::get('/home', [VolunteerController::class, 'index'])->name('volunteer.home');
        Route::get('/volunteer-profile', [user_profileController::class, 'VolunteerProfile'])->name('volunteer.profile');
        Route::post('/volunteer/update/{id}', [user_profileController::class, 'updateVolunteerProfile'])->name('volunteer.updateProfile');
        Route::get('/contact', [VolunteerController::class, 'showContactForm'])->name('volunteer.contact_form');
        Route::get('/testimonial', [VolunteerController::class, 'showTestimonialForm'])->name('volunteer.testi_form');
    });
});
