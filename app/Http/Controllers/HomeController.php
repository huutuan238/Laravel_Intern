<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Database\Eloquent\Model;
use App\Http\Requests;
use App\Models\Post;
use DB;

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
        $all_post = Post::orderby('id', 'desc')->where('status', '1')->get(); # TODO: where('status', '1') --> chuyen sang enum, va dung scope
        $user = Auth::user();
        return view('home')
            ->with('all_post', $all_post)
            ->with('user', $user);
    }
}
