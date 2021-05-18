@extends('welcome')

@section('content')
            <div class="create-post">
              <div class="row">
                <div class="col-sm-2">
                  <img class="rounded-circle " src="{{asset('images/users/user-1.jpg')}}" alt="user" width="40px">
                </div>
                <div class="col-sm-10 col-md-10 m-auto">
                  <form class="form-inline" action="{{URL::to('/update-post/'.$edit_post->id)}}" method="post">
                    @csrf
                    <div class="form-group">
                      <textarea class="form-control" name="content" cols="30" rows="1">{{$edit_post->content}}</textarea>
                      <select name="status" class="custom-select-sm ml-1">
                        <option  value="1">Hien</option>
                        <option  value="0">An</option>
                      </select>
                      <button class="btn btn-primary ml-2" type="submit">Post</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
@endsection
