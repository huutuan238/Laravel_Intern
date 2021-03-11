@extends('welcome')

@section('content')
              <div class="post-content">
              <a href="{{URL::to('/post/'.$post->id)}}">
              <div class="post-container">
                <img src="{{ asset('images/users/user-5.jpg')}}" alt="user" class="profile-photo-md pull-left" />
                <div class="post-detail">
                  <div class="user-info">
                    <h5><a href="timeline.html" class="profile-link">{{ $post->user->name }}</a></h5>
                    <p class="text-muted">{{ $post->created_at }}</p>
                    <?php
                    if($post->user_id == $user->id){
                      ?>
                    <a href="{{URL::to('/edit-post/'.$post->id)}}" class="profile-link">Edit</a>
                    <a href="{{URL::to('/delete-post/'.$post->id)}}" class="profile-link">Delete</a>
                    <?php
                    }?>
                  </div>
                  <div class="reaction">
                    <a class="btn text-green"><i class="icon ion-thumbsup"></i> 13</a>
                    <a class="btn text-red"><i class="fa fa-thumbs-down"></i> 0</a>
                  </div>
                  <div class="line-divider"></div>
                  <div class="post-text">
                    <p>{{ $post->content }}</p>
                  </div>
                  <div class="line-divider"></div>
                  @foreach ($post->comments as $comment)
                    <div class="post-comment">
                      <img src="{{asset('images/users/user-11.jpg')}}" alt="" class="profile-photo-sm" />
                      <p><a href="timeline.html" class="profile-link">{{ $comment->user->name }}</a></br>{{ $comment->content }}</p>
                      <?php
                      if($comment->user_id == $user->id){
                        ?>
                      <a href="{{URL::to('/edit-comment/'.$comment->post_id.'/'.$comment->id)}}" class="profile-link">Edit</a>
                      <a href="{{URL::to('/delete-comment/'.$comment->post_id.'/'.$comment->id)}}" onclick="return confirm('Are you sure delete comment?')" class="profile-link">Delete</a>
                      <?php
                      }?>
                    </div>
                         <a href="{{URL::to('/add-reply/'.$comment->post_id.'/'.$comment->id)}}" class="profile-link">Reply</a>
                        @if($comment->likes->count()== 0)
                            <a href="{{URL::to('/like/'.$user->id.'/'.$post->id.'/'.$comment->id)}}" class="btn text-green"><i class="icon ion-thumbsup"></i></a>
                        @else
                          @foreach ($comment->likes as $like)
                            @if($like->user_id == $user->id )
                            <a href="{{URL::to('/dislike/'.$user->id.'/'.$post->id.'/'.$comment->id.'/'.$like->id)}}" class="btn text-red"><i class="fa fa-thumbs-down"></i></a>
                            @else
                                  <a href="{{URL::to('/like/'.$user->id.'/'.$post->id.'/'.$comment->id)}}" class="btn text-green"><i class="icon ion-thumbsup"></i></a>
                            @endif
                          @endforeach
                        @endif
                        @foreach ($comment->replies as $reply)
                        <div class="comment-reply">
                          <ul>
                            <li>Name : {{ $reply->user->name }}</li>
                            <li>Reply content: {{ $reply->content }}</li>
                          </ul>
                          @if($reply->user_id == $user->id)
                            <a href="{{URL::to('/edit-reply/'.$comment->post_id.'/'.$comment->id.'/'.$reply->id)}}" class="profile-link">Edit</a>
                            <a href="{{URL::to('/delete-reply/'.$comment->post_id.'/'.$comment->id.'/'.$reply->id)}}" onclick="return confirm('Are you sure delete reply?')" class="profile-link">Delete</a>
                          @endif

                        </div>
                        @endforeach
                        <!-- <a href="{{URL::to('/add-reply/'.$comment->post_id.'/'.$comment->id)}}" class="profile-link">Reply</a> -->
                  @endforeach
                  <div class="post-comment">
                    <form action="{{URL::to('save-comment/'.$post->id)}}" method="post">
                      @csrf
                      <img src="{{asset('images/users/user-1.jpg')}}" alt="" class="profile-photo-sm" />
                      <input name="content" type="comment" class="form-control" placeholder="Post a comment">
                      <button class="btn btn-primary">Comment</button>
                    </form>
                  </div>
                </div>
              </div>
              </a>
            </div>
@endsection
