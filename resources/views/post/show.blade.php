@extends('welcome')

@section('content')
          <div class="post mb-2">
            <div class="row border border-info ml-1 mb-1 bg-light">
              <div class="col-sm-2 col-md-2 mt-3">
                <img class="rounded-circle " src="{{asset('images/users/user-1.jpg')}}" alt="user" width="40px">
              </div>
              <div class="col-sm-10 col-md-10">
                <div class="name">
                  <div class="row">
                    <a class="col-10 nav-link" href=""><h5 class="text-primary">{{ $post->user->name }}</h5></a>
                    @if($post->user_id == $user->id)
                    <a class="col-1 nav-link" href="{{URL::to('/edit-post/'.$post->id)}}"><i class="fas fa-edit"></i></a>
                    <a class="col-1 nav-link" href="{{URL::to('/delete-post/'.$post->id)}}" onclick="return confirm('Are you sure delete post?')"><i class="fas fa-trash-alt text-danger"></i></a>
                    @endif
                  </div>
                  <p class="text-muted">{{ $post->created_at }}</p>
                </div>
                <div class="post-content">
                  <p>{{ $post->content }}</p>
                  @foreach ($post->comments as $comment)
                    <div class="row border-bottom bg-white mb-2 ">
                      <div class="col-sm-2 col-md-2 mt-3">
                          <img class="rounded-circle " src="{{asset('images/users/user-2.jpg')}}" alt="user" width="30px">
                      </div>
                      <div class="col-10">
                        <div class="name">
                          <div class="row">
                            <a class="col-sm-9 nav-link" href=""><h6 class="text-primary">{{ $comment->user->name }}</h6></a>
                            @if($comment->user_id == $user->id)
                              <a class="col-sm-1 nav-link" href="{{URL::to('/edit-comment/'.$comment->post_id.'/'.$comment->id)}}"><i class="fas fa-edit"></i></a>
                              <a class="col-sm-1 nav-link" href="{{URL::to('/delete-comment/'.$comment->post_id.'/'.$comment->id)}}" onclick="return confirm('Are you sure delete comment?')"><i class="fas fa-trash-alt text-danger"></i></a>
                            @endif
                          </div>
                        </div>
                        <div class="comment">
                          <p class="text-muted" style="display: block; margin:0em;">{{ $comment->content }}</p>
                          <div class="row">
                              @if($comment->likes->count()== 0)
                                  <a href="{{URL::to('/like/'.$user->id.'/'.$post->id.'/'.$comment->id)}}" class="col-1 nav-link"><i class="far fa-heart"></i></a>
                              @else
                                @foreach ($comment->likes as $like)
                                  @if($like->user_id == $user->id )
                                  <a href="{{URL::to('/dislike/'.$user->id.'/'.$post->id.'/'.$comment->id.'/'.$like->id)}}" class="col-1 nav-link"><i class="fas fa-heart text-danger"></i></a>
                                  @else
                                        <a href="{{URL::to('/like/'.$user->id.'/'.$post->id.'/'.$comment->id)}}" class="col-1 nav-link"><i class="far fa-heart"></i></a>
                                  @endif
                                @endforeach
                              @endif
                              <a class="col-1 nav-link" href="{{URL::to('/add-reply/'.$comment->post_id.'/'.$comment->id)}}"><i class="fas fa-reply"></i></a>
                          </div>
                          @foreach($comment->replies as $reply)
                            <div class="row border-bottom bg-light mb-2">
                              <div class="col-sm-2 col-md-2 mt-3">
                                  <img class="rounded-circle " src="{{asset('images/users/user-3.jpg')}}" alt="user" width="30px">
                              </div>
                              <div class="col-10">
                                <div class="name">
                                  <div class="row">
                                    <a class="col-sm-9 nav-link" href=""><h6 class="text-primary">{{ $reply->user->name }}</h6></a>
                                    @if($reply->user_id == $user->id)
                                      <a class="col-sm-1 nav-link" href="{{URL::to('/edit-reply/'.$comment->post_id.'/'.$comment->id.'/'.$reply->id)}}"><i class="fas fa-edit"></i></a>
                                      <a class="col-sm-1 nav-link" href="{{URL::to('/delete-reply/'.$comment->post_id.'/'.$comment->id.'/'.$reply->id)}}" onclick="return confirm('Are you sure delete reply?')"><i class="fas fa-trash-alt text-danger"></i></a>
                                    @endif
                                  </div>
                                </div>
                                <div class="comment">
                                  <p class="text-muted" style="display: block; margin:0em;">{{ $reply->content }}</p>
                                </div>
                              </div>
                            </div>
                          @endforeach
                        </div>
                      </div>
                    </div>
                  @endforeach
                  <div class="row mb-3">
                    <div class="col-sm-2 col-md-2">
                        <img class="rounded-circle " src="{{asset('images/users/user-2.jpg')}}" alt="user" width="30px">
                    </div>
                    <div class="col-sm-10 col-md-10">
                      <form action="{{URL::to('save-comment/'.$post->id)}}" method="post">
                        @csrf
                        <div class="input-group">
                          <input class="form-control" placeholder="Post a comment" type="text" name="content">
                          <button class="btn btn-primary ml-2" type="submit"><i class="fas fa-paper-plane"></i></button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
@endsection
