@extends('layouts.app')

@section('content')
  <h2>Day la trang home</h2>
  <div class="col-md-4">
    <div class="post-content">
      <!-- <img src="images/post-images/1.jpg" alt="post-image" class="img-responsive post-image" /> -->
      <div class="post-container">
        <!-- <img src="images/users/user-5.jpg" alt="user" class="profile-photo-md pull-left" /> -->
        <div class="post-detail">
          @foreach($all_post as $key=>$post)
          <div class="user-info">
            <h5><a href="timeline.html" class="profile-link">{{$post->user_id}}</a>
              <a href="{{URL::to('/edit-post/'.$post->id)}}" class="profile-link">edit</a>
              <a href="{{URL::to('/delete-post/'.$post->id)}}" class="profile-link">delete</a>
            <p class="text-muted">{{$post->updated_at}}</p>
          </div>
          <div class="line-divider"></div>
          <div class="post-text">
            <p>{{  $post->content }}<i class="em em-anguished"></i> <i class="em em-anguished"></i> <i class="em em-anguished"></i></p>
          </div>
          <div class="line-divider"></div>
          <div class="post-comment">
            <!-- <img src="images/users/user-1.jpg" alt="" class="profile-photo-sm" /> -->
            <input type="text" class="form-control" placeholder="Post a comment">
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
@endsection
