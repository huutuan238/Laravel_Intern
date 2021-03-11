<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Database\Eloquent\Model;
use App\Http\Requests;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Reply;
use Illuminate\Support\Facades\Auth;
use DB;

class ReplyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($post_id, $comment_id)
    {
        // $post = Post::find($post_id);
        $comment = Comment::find($comment_id);
        $user = Auth::user();
        return view('reply.add')->with('user', $user)->with('comment', $comment);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $post_id, $comment_id)
    {
        $reply = new Reply();
        $reply->content = $request->content;
        $reply->user_id = auth()->id();
        $reply->comment_id = $comment_id;
        $reply->save();
        return Redirect::to('post/'.$post_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($post_id, $comment_id, $id)
    {
        $reply = Reply::find($id);
        $comment = Comment::find($comment_id);
        $user = Auth::user();
        return view('reply.edit')->with('comment', $comment)->with('reply', $reply)->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $post_id, $comment_id, $id)
    {
        $reply = Reply::find($id);
        $reply->user_id = auth()->id();
        $reply->comment_id = $comment_id;
        $reply->content = $request->content;
        $reply->save();
        return Redirect::to('post/'.$post_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($post_id, $comment_id, $reply_id)
    {
        Reply::find($reply_id)->delete();
        return Redirect::to('post/'.$post_id);
    }
}
