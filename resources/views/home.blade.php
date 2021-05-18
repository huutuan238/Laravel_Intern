@extends('welcome')
@section('content')
            <div class="create-post">
              <div class="row ">
                <div class="col-sm-1">
                  <img class="rounded-circle " src="{{asset('images/users/user-1.jpg')}}" alt="user" width="40px">
                </div>
                <div class="col-sm-11 col-md-11 m-auto">
                  <form class="form-inline" action="{{URL::to('/save-post')}}" method="post">
                    @csrf
                    <div class="form-group">
                      <textarea class="form-control" name="content" cols="30" rows="1"></textarea>
                      <select name="status" class="custom-select-sm ml-1">
                        <option  value="public">Hien</option>
                        <option  value="private">An</option>
                      </select>
                      <button class="btn btn-primary ml-1" type="submit">Post</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            @foreach($all_post as $post)
            <div class="post">
              <div class="row border border-info m-2 bg-light">
                <div class="col-sm-2 col-md-2 mt-3">
                  <a href="{{URL::to('/post/'.$post->id)}}">
                    <img class="rounded-circle " src="{{asset('images/users/user-1.jpg')}}" alt="user" width="30px">
                  </a>
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
                  </div>
                  <a href="{{URL::to('/post/'.$post->id)}}"><i class="fas fa-comment-dots"></i>({{ $post->comments->count() }})</a>
                </div>
              </div>
            </div>
            @endforeach
@endsection
