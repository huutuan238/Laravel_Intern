@extends('welcome')
@section('content')
            <div class="create-post">
              <div class="row ">
                <div class="col-sm-1">
                  <img class="rounded-circle " src="{{asset('images/users/user-1.jpg')}}" alt="user" width="40px">
                </div>
                <div class="col-sm-11 col-md-11 m-auto">
                  <form class="form-inline" action="{{URL::to('/posts')}}" method="post">
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
            @foreach($search_post as $post)
            <div class="post">
              <div class="row border border-info m-2 bg-light">
                <div class="col-sm-2 col-md-2 mt-3">
                  <a href="{{URL::to('/post/'.$post['_source']['id'])}}">
                    <img class="rounded-circle " src="{{asset('images/users/user-1.jpg')}}" alt="user" width="30px">
                  </a>
                </div>
                <div class="col-sm-10 col-md-10">
                  <div class="name">
                    <div class="row">
                      <a class="col-10 nav-link" href="{{URL::to('/post/'.$post['_source']['id'])}}"><h5 class="text-primary">{{ $post['_source']['user_name'] }}</h5></a>
                    </div>
                  </div>
                  <div class="post-content">
                  <p>{{$post['_source']['content']}}</p>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
@endsection