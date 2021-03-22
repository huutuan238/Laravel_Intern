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
use Carbon\Carbon;

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
        // $startDay = Carbon::now()->startOfDay();
        $today = Carbon::now();
        // $all_post = Post::orderby('id', 'desc')->where('status', 1)->whereDay('created_at', $today)->get(); # TODO: where('status', '1') --> chuyen sang enum, va dung scope
        $all_post = Post::showpost()->orderBy('id', 'desc')->get();
        $user = Auth::user();
        return view('home')
            ->with('all_post', $all_post)
            ->with('user', $user);
    }
}
