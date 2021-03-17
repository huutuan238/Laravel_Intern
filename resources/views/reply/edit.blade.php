@extends('welcome')

@section('content')
                  <div class="post-comment">
                    <form action="{{URL::to('/update-reply/'.$comment->post_id.'/'.$comment->id.'/'.$reply->id)}}" method="post">
                      @csrf
                      <input name="content" type="comment" class="form-control" value="{{ $reply->content}}">
                      <button class="btn btn-primary">Update Reply</button>
                    </form>
                  </div>
@endsection
