@extends('welcome')
@section('content')
            <div class="create-post">
              <form action="{{URL::to('/save-post')}}" method="post">
                @csrf
                <div class="row">
                  <div class="col-md-7 col-sm-7">
                    <div class="form-group">
                      <img src="images/users/user-1.jpg" alt="" class="profile-photo-md" />
                      <textarea name="content" id="exampleTextarea" cols="30" rows="1" class="form-control" placeholder="Write what you wish"></textarea>
                    </div>
                    <label for="inputSuccess">Hiển thị</label>
                    <select name="status">
                          <option value="0">Ẩn</option>
                          <option value="1">Hiện</option>
                    </select>
                  </div>
                  <div class="col-md-5 col-sm-5">
                    <div class="tools">
                      <ul class="publishing-tools list-inline">
                        <li><a href="#"><i class="ion-compose"></i></a></li>
                        <li><a href="#"><i class="ion-images"></i></a></li>
                        <li><a href="#"><i class="ion-ios-videocam"></i></a></li>
                        <li><a href="#"><i class="ion-map"></i></a></li>
                      </ul>
                      <!-- <button class="btn btn-primary pull-right">Publish</button> -->
                      <input class="btn btn-primary pull-right" type="submit" name="submit">
                    </div>
                  </div>
                </div>
              </form>
            </div><!-- Post Create Box End-->

            <!-- Post Content
            ================================================= -->
            @foreach($all_post as $post)
            <div class="post-content">
              <a href="{{URL::to('/post/'.$post->id)}}">
              <div class="post-container">
                <img src="images/users/user-5.jpg" alt="user" class="profile-photo-md pull-left" />
                <div class="post-detail">
                  <div class="user-info">
                    <h5><a href="timeline.html" class="profile-link">{{ $post->user->name }}</a> <span class="following">following</span></h5>
                    <p class="text-muted">{{ $post->created_at }}</p>
                    <?php
                    if($post->user_id == $user->id){
                      ?>
                    <a href="{{URL::to('/edit-post/'.$post->id)}}" class="profile-link">Edit</a>
                    <a href="{{URL::to('/delete-post/'.$post->id)}}" onclick="return confirm('Are you sure delete post?')" class="profile-link">Delete</a>
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
                </div>
              </div>
              </a>
            </div>
            @endforeach
@endsection
