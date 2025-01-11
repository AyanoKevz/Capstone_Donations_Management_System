<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
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

        $news = News::all();
        return view('homepage.index', compact('news'));
    }

    public function moreNews($id)
    {
        $news = News::findOrFail($id);
        return view('homepage.more_news', compact('news'));
    }
}
