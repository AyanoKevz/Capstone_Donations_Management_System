<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Testimonial;
use App\Models\UserAccount;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Mail\AccountUpdated;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            switch (Auth::user()->role_name) {
                case 'Donor':
                    return redirect()->route('donor.home');
                case 'Volunteer':
                    return redirect()->route('volunteer.home');
                default:
                    Auth::logout();
                    return redirect()->route('home')
                        ->with('error', 'Invalid user role.');
            }
        }

        $news = News::all(); // Fetch news
        $testimonials = Testimonial::with('user')->get();
        return view('homepage.index', compact('news', 'testimonials'));
    }

    public function moreNews($id)
    {
        $news = News::findOrFail($id);
        $otherNews = News::where('id', '!=', $id)->latest()->get();
        return view('homepage.more_news', compact('news', 'otherNews'));
    }


    // Step 1: Send Reset Link
    public function sendResetLink(Request $request)
    {
        $request->validate(['find_email' => 'required|email']);
        $email = $request->input('find_email');

        $user = UserAccount::where('email', $email)->first();

        if (!$user) {
            return redirect()->route('home')
                ->with('error', 'Sorry, email not found.')
                ->withInput()
                ->header('Location', route('home') . '#portals');
        }

        // Generate token
        $token = Str::random(64);

        // Save token to database
        DB::table('password_resets')->updateOrInsert(
            ['email' => $email],
            ['token' => $token, 'created_at' => now()]
        );

        // Prepare email data
        $resetLink = route('reset-password', ['token' => $token]);
        $logoPath = public_path('assets/img/systemLogo.png');

        // Send reset email
        Mail::send('emails.reset-password', [
            'username' => $user->username,
            'resetLink' => $resetLink,
            'logoPath' => $logoPath,
        ], function ($message) use ($email) {
            $message->to($email)->subject('Password Reset Request');
        });

        return redirect()->route('home')
            ->with('success', 'Password reset link sent to your email.')
            ->header('Location', route('home') . '#portals');
    }

    // Step 2: Show Reset Form
    public function showResetForm($token)
    {
        DB::table('password_resets')->where('created_at', '<', Carbon::now()->subMinutes(2))->delete();
        $tokenData = DB::table('password_resets')->where('token', $token)->first();

        if (!$tokenData || Carbon::parse($tokenData->created_at)->addMinutes(2)->isPast()) {
            return redirect()->route('home')
                ->with('error', 'Invalid or expired reset link.')
                ->header('Location', route('home') . '#portals');
        }

        return view('homepage.resetpass', ['token' => $token]);
    }

    // Step 3: Reset Password
    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:8',
            'token' => 'required',
        ]);

        $tokenData = DB::table('password_resets')->where('token', $request->input('token'))->first();

        if (!$tokenData || Carbon::parse($tokenData->created_at)->addMinutes(2)->isPast()) {
            return redirect()->route('home')
                ->with('error', 'Invalid or expired reset link.')
                ->withInput()
                ->header('Location', route('home') . '#portals');
        }

        $user = UserAccount::where('email', $tokenData->email)->first();
        if (!$user) {
            return redirect()->route('home')
                ->with('error', 'User not Found.')
                ->withInput()
                ->header('Location', route('home') . '#portals');
        }

        $user->update(['password' => Hash::make($request->input('password'))]);

        DB::table('password_resets')->where('email', $tokenData->email)->delete();

        $details = [
            'changes' => ['password'],
            'username' => $user->username,
        ];
        Mail::to($user->email)->send(new AccountUpdated($details));

        return redirect()->route('home')
            ->with('success', 'Your password has been successfully reset.')
            ->withInput()
            ->header('Location', route('home') . '#portals');
    }
}
