<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DonorController extends Controller
{

    public function index()
    {
        return view('users.donor.home');
    }

    public function showChapters()
    {
        return view('users.donor.chapters');
    }
    public function review()
    {
        return view('users.donor.review');
    }
    
}
