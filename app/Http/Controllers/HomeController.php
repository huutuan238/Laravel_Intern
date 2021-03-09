<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
// use App\Models\User;use Illuminate\Http\Request;
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
        $all_post = Post::orderby('id','desc')->get();
        $user = Auth::user();
        $comments = DB::table('posts')
            ->join('comments','comments.post_id', '=', 'posts.id')
            ->get();
        return view('home')->with('all_post', $all_post)->with('comments', $comments)->with('user', $user);
    }
}
