<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.home' , [
            'posts_count' => Post :: all()->count(),
            'trashed_posts_count' => Post :: onlyTrashed()->get()->count(),
            'categories_count' => Category :: all()->count(),
            'users_count' => User :: all()->count(),
        ]);
    }
}
