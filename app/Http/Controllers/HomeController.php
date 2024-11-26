<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;

class HomeController extends Controller
{
    public function index()
    {
        $news = News::all();
        return view('homepage.index', compact('news'));
    }

    public function moreNews($id)
    {
        $news = News::findOrFail($id);
        return view('homepage.more_news', compact('news'));
    }
}
