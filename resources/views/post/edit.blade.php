@extends('welcome')

@section('content')
            <div class="create-post">
              <form action="{{URL::to('/update-post/'.$edit_post->id)}}" method="post">
                @csrf
                <div class="row">
                  <div class="col-md-7 col-sm-7">
                    <div class="form-group">
                      <img src="images/users/user-1.jpg" alt="" class="profile-photo-md" />
                      <textarea name="content" id="exampleTextarea" cols="30" rows="1" class="form-control">{{$edit_post->content}}</textarea>
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
@endsection
