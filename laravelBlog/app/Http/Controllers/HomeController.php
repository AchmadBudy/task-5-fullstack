<?php

namespace App\Http\Controllers;

use App\Models\post;
use App\Models\User;
use Illuminate\Http\Request;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = post::orderBy('id', 'desc')->paginate(10);
        return view('home', compact('posts'));
    }

    public function detailPost($id)
    {
        $post = post::findOrFail($id);
        return view('post', compact('post'));
    }
}
