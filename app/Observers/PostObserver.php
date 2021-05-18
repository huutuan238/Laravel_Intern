<?php

namespace App\Observers;

use App\Models\Post;
use Pusher\Pusher;
use Elasticsearch\ClientBuilder;
class PostObserver
{
    /**
     * Handle the Post "created" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function created(Post $post)
    {
        // $post->unique_id = 'PR-'.$product->id;
        $client = ClientBuilder::create()->build();
        $params = [
            'index' => 'my_index',
            'id'    => $post->id,
            'body'  => [
                'id' => $post->id,
                'user_name' => $post->user->name,
                'content' => $post->content
            ]
        ];
        
        $client->index($params);
        $post->save();
    }

    /**
     * Handle the Post "updated" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function updated(Post $post)
    {
        //
    }

    /**
     * Handle the Post "deleted" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function deleted(Post $post)
    {
        //
    }

    /**
     * Handle the Post "restored" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function restored(Post $post)
    {
        //
    }

    /**
     * Handle the Post "force deleted" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function forceDeleted(Post $post)
    {
        //
    }
}
