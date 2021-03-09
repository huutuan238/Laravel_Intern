@extends('welcome')

@section('content')
                  <div class="post-comment">
                    <form action="{{URL::to('/update-comment/'.$edit_comment->post_id.'/'.$edit_comment->id)}}" method="post">
                      @csrf
                      <input name="content" type="comment" class="form-control" value="{{ $edit_comment->content }}">
                      <button class="btn btn-primary">Update Comment</button>
                    </form>
                  </div>
@endsection
