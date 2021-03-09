<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Database\Eloquent\Model;
use App\Http\Requests;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;



class CommentController extends Controller
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
    public function create()
    {
        return view('comment.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$post_id)
    {
        // $post_id = Post::find($request->post_id);
        // $data = $request->all();
        // print_r($data);
        $comment = new Comment();
        $comment->content = $request->content;
        $comment->user_id = auth()->id();
        $comment->post_id = $post_id;
        $comment->save();
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
    public function edit($post_id, $id)
    {
        $edit_comment = Comment::find($id);
        $user = Auth::user();
        return view('comment.edit')->with('edit_comment', $edit_comment)->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$post_id, $id)
    {

        $comment = Comment::find($id);
        $comment->content = $request->content;
        $comment->user_id = auth()->id();
        $comment->save();
        return Redirect::to('post/'.$post_id);
    }

    public function like($user_id, $post_id, $comment_id)
    {
        $like = new Like();
        $like->user_id = $user_id;
        $like->post_id = $post_id;
        $like->comment_id = $comment_id;
        $like->status = '1';
        $like->save();
        return Redirect::to('post/'.$post_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($post_id, $id)
    {
        Comment::find($id)->delete();
        return Redirect::to('post/'.$post_id);
    }
}
