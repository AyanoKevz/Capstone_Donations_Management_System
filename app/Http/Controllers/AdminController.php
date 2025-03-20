<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Chapter;
use App\Models\UserAccount;
use App\Models\Donor;
use App\Models\CashDonation;
use App\Models\Donation;
use App\Models\DonationItem;
use App\Models\Appointment;
use App\Models\Admin;
use App\Models\Volunteer;
use App\Models\News;
use App\Models\FundRequest;
use App\Models\DonationRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\AccountUpdated;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Cache\RateLimiter;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    // ADMIN LOGIN
    public function showLoginForm()
    {
        // If the admin is already logged in, redirect to the dashboard
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.admin_login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['username' => 'Invalid username or password']);
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->route('admin.login')->with('success', 'You have been logged out successfully.');
    }

    // ADMIN Send email form  
    public function showFindEmailForm()
    {
        return view('admin.admin_find_email');
    }

    // Send Reset Link
    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $email = $request->input('email');

        $rateLimitKey = 'admin-password-reset:' . $email;
        $limiter = app(RateLimiter::class);

        if ($limiter->tooManyAttempts($rateLimitKey, 1)) {
            return redirect()->route('admin.login')
                ->with('error', 'You can request a password reset only once every 3 minutes.');
        }

        $limiter->hit($rateLimitKey, 180);

        $admin = Admin::where('email', $email)->first();

        if (!$admin) {
            return redirect()->route('admin.findEmail')
                ->with('error', 'Sorry, email not found.')
                ->withInput();
        }

        $token = Str::random(64);
        DB::table('password_resets')->updateOrInsert(
            ['email' => $email],
            ['token' => $token, 'created_at' => now()]
        );

        $resetLink = route('admin.resetPasswordForm', ['token' => $token]);
        $logoPath = public_path('assets/img/systemLogo.png');

        try {
            Mail::send('emails.reset-password', [
                'username' => $admin->username,
                'resetLink' => $resetLink,
                'logoPath' => $logoPath,
            ], function ($message) use ($email) {
                $message->to($email)->subject('Admin Password Reset Request');
            });
        } catch (\Exception $e) {
            Log::error('Error sending admin password reset email: ' . $e->getMessage());
            return redirect()->route('admin.findEmail')
                ->with('error', 'Failed to send password reset email. Please try again later.');
        }

        return redirect()->route('admin.login')
            ->with('success', 'A reset link has been sent to your email.');
    }

    // Show Reset Form
    public function showResetForm($token)
    {
        DB::table('password_resets')->where('created_at', '<', Carbon::now()->subMinutes(2))->delete();

        $tokenData = DB::table('password_resets')->where('token', $token)->first();

        if (!$tokenData) {
            return redirect()->route('admin.login')
                ->with('error', 'Link is invalid or has expired.');
        }

        $expiresAt = Carbon::parse($tokenData->created_at)->addMinutes(2);
        $remainingTime = Carbon::now()->diffInSeconds($expiresAt);

        return view('admin.admin_forgot', [
            'token' => $token,
            'remainingTime' => $remainingTime,
        ]);
    }

    // Reset Password
    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:8',
            'token' => 'required',
        ]);

        $tokenData = DB::table('password_resets')->where('token', $request->input('token'))->first();

        if (!$tokenData || Carbon::parse($tokenData->created_at)->addMinutes(2)->isPast()) {
            return redirect()->route('admin.findEmail')
                ->with('error', 'Invalid or expired reset link.');
        }

        $admin = Admin::where('email', $tokenData->email)->first();
        if (!$admin) {
            return redirect()->route('admin.findEmail')
                ->with('error', 'Admin not found.');
        }

        $admin->update(['password' => Hash::make($request->input('password'))]);

        DB::table('password_resets')->where('email', $tokenData->email)->delete();

        $details = [
            'changes' => ['password'],
            'username' => $admin->username,
        ];

        try {
            Mail::to($admin->email)->send(new AccountUpdated($details));
        } catch (\Exception $e) {
            Log::error('Failed to send account update email: ' . $e->getMessage());
        }

        return redirect()->route('admin.login')
            ->with('success', 'Your password has been successfully reset.');
    }



    // ADMIN DASHBOARD
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    // ADMIN CHAPTERS
    public function chapters()
    {
        $chapters = Chapter::all();
        return view('admin.chapters', compact('chapters'));
    }


    public function CreateChapter(Request $request)
    {
        $request->validate([
            'chapter_name' => 'required|string|max:100',
            'address' => 'required|string|max:255',
            'region' => 'required|string|max:100',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
        ]);

        Chapter::create([
            'chapter_name' => $request->chapter_name,
            'address' => $request->address,
            'region' => $request->region,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        return redirect()->route('admin.chapters')->with('success', 'Chapter created successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'chapter_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'region' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $chapter = Chapter::findOrFail($id);

        $chapter->update([
            'chapter_name' => $request->chapter_name,
            'address' => $request->address,
            'region' => $request->region,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        return redirect()->back()->with('success', 'Chapter updated successfully!');
    }

    public function destroy($id)
    {

        $chapter = Chapter::findOrFail($id);

        $chapter->delete();
        return redirect()->back()->with('success', 'Chapter deleted successfully!');
    }

    public function showAppointments()
    {
        $appointments = Appointment::with(['volunteer.user', 'volunteer.chapter'])
            ->whereHas('volunteer.user', function ($query) {
                $query->where('is_verified', false);
            })
            ->get();

        return view('admin.appointments', compact('appointments'));
    }

    public function delete_appointment(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();

        return redirect()->back()->with('success', 'Appointment deleted successfully.');
    }


    //ADMIN PRFOLIE
    public function admin_profile()
    {
        $chapters = Chapter::all();
        return view('admin.admin_profile', compact('chapters'));
    }



    public function updateProfile(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);

        // Validate the request
        $request->validate([
            'email' => 'required|email|unique:admin,email,' . $id,
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $changes = [];

        // Update profile image if provided
        if ($request->hasFile('profile_image')) {
            if ($admin->profile_image && Storage::disk('public')->exists($admin->profile_image)) {
                Storage::disk('public')->delete($admin->profile_image);
            }
            $imagePath = $request->file('profile_image')->store('admin_photos', 'public');
            if ($admin->profile_image !== $imagePath) {
                $changes[] = 'profile_image';
                $admin->profile_image = $imagePath;
            }
        }

        // Update name if changed
        if ($admin->name !== $request->input('name')) {
            $changes[] = 'name';
            $admin->name = $request->input('name');
        }

        // Update email if changed
        if ($admin->email !== $request->input('email')) {
            $changes[] = 'email';
            $admin->email = $request->input('email');
        }

        // Update chapter_id if changed
        if ($admin->chapter_id != $request->input('chapter')) { // Use loose comparison (!=)
            $changes[] = 'chapter_id';
            $admin->chapter_id = $request->input('chapter');
        }

        // Check if any changes were made
        if (empty($changes)) {
            return back()->with('info', 'No changes were made to your profile.');
        }

        // Save changes
        $admin->save();

        return back()->with('success', 'Profile updated successfully.');
    }

    public function updateAccount(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);

        $request->validate([
            'username' => 'required',
            'password' => 'nullable|confirmed|min:8',
        ]);
        $existingAdmin = Admin::where('username', $request->input('username'))
            ->where('id', '!=', $id)
            ->first();

        if ($existingAdmin) {
            return back()->with('error', 'The username is already in use by another account.');
        }

        $changes = [];

        // Update username if it has changed
        if ($admin->username !== $request->input('username')) {
            $changes[] = 'username';
            $admin->username = $request->input('username');
        }

        // Update password if provided
        if ($request->filled('password')) {
            // Check if the current password matches
            if (!Hash::check($request->input('oldPassword'), $admin->password)) {
                return back()->with('error', 'Current password is incorrect.');
            }

            // Update the password
            $changes[] = 'password';
            $admin->password = Hash::make($request->input('password'));
        }

        if (empty($changes)) {
            return back()->with('info', 'No changes were made to your account.');
        }

        $admin->save();

        // Send email notification about the changes
        $details = [
            'changes' => $changes,
            'username' => $admin->username,
        ];
        Mail::to($admin->email)->send(new AccountUpdated($details));

        return back()->with('success', 'Account updated successfully.');
    }


    //All ADMIN
    public function adminList()
    {
        $admins = Admin::all();
        return view('admin.admin_list', compact('admins'));
    }


    public function deleteAdmin(Request $request)
    {
        $admin = Admin::find($request->id);

        if ($admin) {
            if ($admin->profile_image && Storage::disk('public')->exists($admin->profile_image)) {
                Storage::disk('public')->delete($admin->profile_image);
            }
            $admin->delete();
            return redirect()->back()->with('success', 'Admin deleted successfully.');
        }

        return redirect()->back()->with('error', 'Admin not found.');
    }


    public function CreateAdmin(Request $request)
    {
        // Get the currently logged-in admin
        $loggedInAdmin = Auth::guard('admin')->user();

        // Validate the request (excluding 'chapter' since it will be auto-assigned)
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admin,email',
        ]);

        // Generate username and password
        $username = 'uniaid_admin' . rand(1000, 9999);
        $password = strtoupper(Str::random(4)) . rand(1000, 9999); // 4 letters + 4 digits = 8 characters

        // Set default profile image
        $defaultImagePath = 'assets/img/PRC_logo.png';
        $profileImagePath = 'admin_photos/' . Str::random(10) . '_PRC_logo.png';
        Storage::disk('public')->put($profileImagePath, file_get_contents(public_path($defaultImagePath)));

        // Create the admin
        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $username,
            'password' => bcrypt($password),
            'profile_image' => $profileImagePath,
            'chapter_id' => $loggedInAdmin->chapter_id, // Assign the logged-in admin's chapter_id
        ]);

        // Prepare email details
        $details = [
            'name' => $request->name,
            'username' => $username,
            'password' => $password,
            'logoPath' => public_path('assets/img/systemLogo.png'),
            'chapter' => $loggedInAdmin->chapter->chapter_name, // Include chapter name from the logged-in admin
        ];

        // Send email
        Mail::send('emails.admin_credentials', $details, function ($message) use ($request) {
            $message->to($request->email)
                ->subject('Your UniAid Admin Account Credentials');
        });

        return redirect()->back()->with('success', 'Admin account created successfully, and credentials have been emailed.');
    }

    //Donor LIST
    public function allDonors(Request $request)
    {
        // Get the filters from the request
        $statusFilter = $request->input('status', 'all'); // Default: all
        $accountTypeFilter = $request->input('account_type', 'all'); // Default: all

        // Fetch donors based on the filters
        $donors = UserAccount::with(['roles', 'donor'])
            ->whereHas('roles', function ($query) {
                $query->where('role_name', 'Donor');
            })
            ->when($statusFilter !== 'all', function ($query) use ($statusFilter) {
                if ($statusFilter === 'active') {
                    $query->where('is_verified', true);
                } elseif ($statusFilter === 'inactive') {
                    $query->where('is_verified', false);
                }
            })
            ->when($accountTypeFilter !== 'all', function ($query) use ($accountTypeFilter) {
                $query->where('account_type', $accountTypeFilter);
            })
            ->get();

        return view('admin.donor_list', compact('donors', 'statusFilter', 'accountTypeFilter'));
    }

    public function deactivateDonor($userId)
    {
        // Find the user
        $user = UserAccount::find($userId);

        if ($user) {
            // Deactivate the user
            $user->update(['is_verified' => false]);

            // Prepare email details
            $details = [
                'username' => $user->username,
                'role' => $user->roles->first()->role_name, // Assuming the user has a role relationship
                'logoPath' => public_path('assets/img/systemLogo.png'), // Path to your logo
            ];

            // Send email notification
            Mail::send('emails.account_deactivate', $details, function ($message) use ($user) {
                $message->to($user->email)
                    ->subject('Your Account Has Been Deactivated');
            });
        }

        return redirect()->route('admin.donorList')->with('success', 'Donor deactivated successfully!');
    }

    //VOLUNTEERS LIST
    public function allVolunteers(Request $request)
    {
        // Get the logged-in admin
        $admin = Auth::guard('admin')->user();

        // Get the filter from the request (default is 'all')
        $statusFilter = $request->input('status', 'all');

        // Fetch volunteers based on the filter and the admin's chapter
        $volunteers = UserAccount::with(['roles', 'volunteer.chapter'])
            ->whereHas('roles', function ($query) {
                $query->where('role_name', 'Volunteer');
            })
            ->whereHas('volunteer', function ($query) use ($admin) {
                $query->where('chapter_id', $admin->chapter_id); // Filter by admin's chapter
            })
            ->when($statusFilter !== 'all', function ($query) use ($statusFilter) {
                if ($statusFilter === 'active') {
                    $query->where('is_verified', true);
                } elseif ($statusFilter === 'inactive') {
                    $query->where('is_verified', false);
                }
            })
            ->get();

        return view('admin.volunteer_list', compact('volunteers', 'statusFilter'));
    }

    public function deactivateVolunteer($userId)
    {
        // Find the user
        $user = UserAccount::find($userId);

        if ($user) {
            // Deactivate the user
            $user->update(['is_verified' => false]);

            // Prepare email details
            $details = [
                'username' => $user->username,
                'role' => $user->roles->first()->role_name, // Assuming the user has a role relationship
                'logoPath' => public_path('assets/img/systemLogo.png'), // Path to your logo
            ];

            // Send email notification
            Mail::send('emails.account_deactivate', $details, function ($message) use ($user) {
                $message->to($user->email)
                    ->subject('Your Account Has Been Deactivated');
            });
        }

        return redirect()->route('admin.volunteerList')->with('success', 'Volunteer deactivated successfully!');
    }


    //NEWS

    public function showNews()
    {
        $news = News::all();
        return view('admin.news', compact('news'));
    }

    public function NewsForm()
    {
        return view('admin.news_create');
    }

    public function CreateNews(Request $request)
    {
        $validatedData = $request->validate([
            'subtitle' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image_url_1' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_url_2' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            $imagePath1 = null;
            $imagePath2 = null;

            $admin = Auth::guard('admin')->user();

            if ($request->hasFile('image_url_1')) {
                $imagePath1 = $request->file('image_url_1')->store('news_photos', 'public');
            }

            if ($request->hasFile('image_url_2')) {
                $imagePath2 = $request->file('image_url_2')->store('news_photos', 'public');
            }
            $content = strip_tags($validatedData['content']);

            News::create([
                'admin_id' => $admin->id,
                'subtitle' => $validatedData['subtitle'],
                'title' => $validatedData['title'],
                'content' => $content,
                'image_url_1' => $imagePath1,
                'image_url_2' => $imagePath2,
            ]);

            return redirect()->route('admin.news')->with('success', 'News post created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while creating the news. Please try again.');
        }
    }

    // Edit News Form   
    public function EditNewsForm($id)
    {
        $news = News::findOrFail($id);

        return view('admin.news_create', compact('news'));
    }

    // Update News
    public function UpdateNews(Request $request, $id)
    {
        $news = News::find($id);
        $validatedData = $request->validate([
            'subtitle' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image_url_1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_url_2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $changesMade = false;
        if ($news->title !== $validatedData['title']) {
            $news->title = $validatedData['title'];
            $changesMade = true;
        }

        if (
            $news->subtitle !== $validatedData['subtitle']
        ) {
            $news->subtitle = $validatedData['subtitle'];
            $changesMade = true;
        }

        if (
            $news->content !== strip_tags($validatedData['content'])
        ) {
            $news->content = strip_tags($validatedData['content']);
            $changesMade = true;
        }

        if ($request->hasFile('image_url_1')) {
            if ($news->image_url_1) {
                Storage::disk('public')->delete($news->image_url_1);
            }
            $news->image_url_1 = $request->file('image_url_1')->store('news_photos', 'public');
            $changesMade = true;
        }
        if ($request->hasFile('image_url_2')) {
            if ($news->image_url_2) {
                Storage::disk('public')->delete($news->image_url_2);
            }

            $news->image_url_2 = $request->file('image_url_2')->store('news_photos', 'public');
            $changesMade = true;
        }

        if (!$changesMade) {
            return redirect()->route('admin.news')->with('info', 'No changes were made to the news post.');
        }

        $news->save();

        return redirect()->route('admin.news')->with('success', 'News updated successfully.');
    }


    public function deleteNews(Request $request)
    {
        $news = News::find($request->id);

        if ($news) {

            if ($news->image_url_1 && Storage::disk('public')->exists($news->image_url_1)) {
                Storage::disk('public')->delete($news->image_url_1);
            }

            if ($news->image_url_2 && Storage::disk('public')->exists($news->image_url_2)) {
                Storage::disk('public')->delete($news->image_url_2);
            }

            $news->delete();

            return redirect()->back()->with('success', 'News deleted successfully along with associated images.');
        }

        return redirect()->back()->with('error', 'News not found.');
    }


    public function allRequest(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        // Retrieve filter values from the request
        $filter = $request->input('type', 'all'); // Default is 'all'
        $urgencyFilter = $request->input('urgency', 'all'); // Default is 'all'
        $statusFilter = $request->input('status', 'Pending'); // Default is 'Pending'

        // Fetch fund and donation requests only for the admin's chapter
        $fundRequests = FundRequest::where('created_by_admin_id', $admin->id);
        $donationRequests = DonationRequest::where('created_by_admin_id', $admin->id);

        // Apply type filter
        if ($filter === 'cash') {
            $fundRequests = $fundRequests->get();
            $donationRequests = collect(); // Empty collection for In-Kind
        } elseif ($filter === 'in-kind') {
            $donationRequests = $donationRequests->get();
            $fundRequests = collect(); // Empty collection for Cash
        } else {
            $fundRequests = $fundRequests->get();
            $donationRequests = $donationRequests->get();
        }

        // Apply urgency filter
        if ($urgencyFilter !== 'all') {
            $fundRequests = $fundRequests->filter(function ($request) use ($urgencyFilter) {
                return $request->urgency === $urgencyFilter;
            });
            $donationRequests = $donationRequests->filter(function ($request) use ($urgencyFilter) {
                return $request->urgency === $urgencyFilter;
            });
        }

        // Apply status filter
        if ($statusFilter !== 'all') {
            $fundRequests = $fundRequests->filter(function ($request) use ($statusFilter) {
                return $request->status === $statusFilter;
            });
            $donationRequests = $donationRequests->filter(function ($request) use ($statusFilter) {
                return $request->status === $statusFilter;
            });
        }

        return view('admin.allRequest', compact('fundRequests', 'donationRequests', 'filter', 'urgencyFilter', 'statusFilter'));
    }

    public function requestDetails($id, $type)
    {
        $status = request()->query('status', 'all');

        if ($type === 'cash') {
            $fundRequest = FundRequest::find($id);
            $donationRequest = null;
        } else {
            $fundRequest = null;
            $donationRequest = DonationRequest::find($id);
        }

        $requestedItems = $donationRequest ? $donationRequest->items : collect();

        $cashDonations = $fundRequest ? $fundRequest->cashDonations()
            ->when($status !== 'all', function ($query) use ($status) {
                return $query->where('status', $status);
            })->get() : collect();

        $totalCashDonated = $fundRequest ? $fundRequest->cashDonations()->sum('amount') : 0;

        $inKindDonations = $donationRequest ? $donationRequest->donations()
            ->when($status !== 'all', function ($query) use ($status) {
                return $query->where('status', $status);
            })->get() : collect();

        $isCashRequest = ($type === 'cash');

        // Get location details
        $request = $fundRequest ?? $donationRequest;
        $location = $request->location;
        $formattedLocation = $location->region === "NCR"
            ? "{$location->barangay}, {$location->city_municipality}, Metro Manila, Philippines"
            : "{$location->barangay}, {$location->city_municipality}, {$location->province}, {$location->region}, Philippines";

        return view('admin.requestDetails', compact(
            'cashDonations',
            'inKindDonations',
            'totalCashDonated',
            'status',
            'id',
            'isCashRequest',
            'formattedLocation',
            'request',
            'requestedItems'
        ));
    }

    public function showCashDonationDetails($id)
    {
        $cashDonation = CashDonation::findOrFail($id);
        return view('admin.cash_details', compact('cashDonation'));
    }

    public function showInKindDonationDetails($id)
    {
        $inKindDonation = Donation::with('donationItems')->findOrFail($id);
        return view('admin.inkind_details', compact('inKindDonation'));
    }


    public function verifyInKindDonation($donationId)
    {
        // Find the donation
        $donation = Donation::find($donationId);

        if (!$donation) {
            return redirect()->back()->with('error', 'Donation not found.');
        }

        // Update status from 'pending' to 'ongoing'
        $donation->status = 'ongoing';
        $donation->save();

        // Check if the donation is based on a request
        if ($donation->donation_request_id) {
            $donationRequest = DonationRequest::find($donation->donation_request_id);
            if ($donationRequest) {
                $donationRequest->checkIfFulfilled(); // Only run for donations tied to a request
            }
        }

        // Prepare email details
        $logoPath = public_path('assets/img/systemLogo.png');
        $chapter = $donation->chapter->chapter_name; // Assuming donation has a relationship with chapter
        $donationItems = $donation->donationItems;

        // Customize email message based on donation method
        $emailMessage = ''; // Initialize the variable
        if ($donation->donation_method === 'drop-off') {
            $emailMessage = 'Thank you for your donation! Please wait until you bring your donation to the chapter.';
        } elseif ($donation->donation_method === 'pickup') {
            $emailMessage = 'Thank you for your donation! You will receive a text or email once a volunteer is available for the pick-up.';
        }

        $details = [
            'logoPath' => $logoPath,
            'chapter' => $chapter,
            'donation' => $donation,
            'donationItems' => $donationItems,
            'type' => 'in-kind',
            'emailMessage' => $emailMessage, // Pass the email message to the template
        ];

        // Send email
        Mail::send('emails.verified_donation', $details, function ($message) use ($donation) {
            $message->to($donation->donor->user->email) // Access email from UserAccount
                ->subject('Your Donation Has Been Verified');
        });

        return redirect()->back()->with('success', 'Donation verified successfully.');
    }


    public function allQuickDonations(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        $chapterId = $admin->chapter_id;

        $statusFilter = $request->query('status', '');
        $typeFilter = $request->query('type', 'all');

        // Get cash donations with no request_id and pending/ongoing status
        $cashDonationsQuery = CashDonation::where('chapter_id', $chapterId)
            ->whereNull('fund_request_id')
            ->whereIn('status', ['Pending', 'Ongoing']);

        // Get in-kind donations with no request_id and pending/ongoing status
        $inKindDonationsQuery = Donation::where('chapter_id', $chapterId)
            ->whereNull('donation_request_id')
            ->whereIn('status', ['Pending', 'Ongoing']);

        // Apply status filter
        if ($statusFilter) {
            $cashDonationsQuery->where('status', $statusFilter);
            $inKindDonationsQuery->where('status', $statusFilter);
        }

        // Apply type filter
        if ($typeFilter === 'cash') {
            // Ensure no in-kind donations are returned
            $inKindDonationsQuery->whereRaw('1 = 0'); // This will make the query return no results
        } elseif ($typeFilter === 'in-kind') {
            // Ensure no cash donations are returned
            $cashDonationsQuery->whereRaw('1 = 0'); // This will make the query return no results
        }

        // Execute the queries
        $cashDonations = $cashDonationsQuery->get();
        $inKindDonations = $inKindDonationsQuery->get();

        return view('admin.quickDonations', compact('cashDonations', 'inKindDonations', 'statusFilter', 'typeFilter'));
    }
}
