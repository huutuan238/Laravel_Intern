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
use App\Models\Like;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreRequest;
use Mail;
use App\Mail\CommentPost;
use App\Notifications\TestNotification;
use Pusher\Pusher;
use DB;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
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
    public function store(StoreRequest $request, $post_id)
    {
        $comment = new Comment();
        $post = Post::findOrFail($post_id);
        // $user = Auth::user();
        $user  = $post->user;
        $comment->content = $request->content;
        $comment->user_id = auth()->id();
        $comment->post_id = $post_id;
        // $data['content'] = $request->content;
        // $data['user'] = Auth::user()->name;
        // $data['post_id'] = $post_id;
        // $user->notify(new TestNotification($data));
        // $options = array(
        //     'cluster' => 'ap1',
        //     'encrypted' => true
        // );

        // $pusher = new Pusher(
        //     env('PUSHER_APP_KEY'),
        //     env('PUSHER_APP_SECRET'),
        //     env('PUSHER_APP_ID'),
        //     $options
        // );

        // $pusher->trigger('NotificationEvent', 'send-message', $data);
        // $comment->save();
        // return Redirect::to('post/'.$post_id);
        //send mail
        if ($post->user->id != auth()->id()) {
            Mail::to($post->user->email)->send(new CommentPost($comment));
            $comment->save();
            return Redirect::to('post/'.$post_id);
         }
        else {
            $comment->save();
            return Redirect::to('post/'.$post_id);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($post_id, $id)
    {
        # TODO: check neu ko thay comment, invalid $id
        $edit_comment = Comment::findOrFail($id);
        $this->authorize('update', $edit_comment);
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
    public function update(StoreRequest $request, $post_id, $id)
    {
        $comment = Comment::findOrFail($id);
        $this->authorize('update', $comment);
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
        $like->save();
        return Redirect::to('post/'.$post_id);
    }

    public function dislike($user_id, $post_id, $comment_id, $like_id)
    {
        $like = Like::findOrFail($like_id)->delete();
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
        $comment = Comment::findOrFail($id);
        $this->authorize('delete', $comment);
        $comment->delete();
        return Redirect::to('post/'.$post_id);
    }
}
