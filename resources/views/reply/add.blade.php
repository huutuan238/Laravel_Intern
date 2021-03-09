@extends('welcome')

@section('content')
                  <div class="post-comment">
                    <form action="{{URL::to('/save-reply/'.$comment->post_id.'/'.$comment->id)}}" method="post">
                      @csrf
                      <input name="content" type="comment" class="form-control" value="">
                      <button class="btn btn-primary">Reply</button>
                    </form>
                  </div>
@endsection
