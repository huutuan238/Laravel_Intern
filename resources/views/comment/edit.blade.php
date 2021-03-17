@extends('welcome')

@section('content')
                  <div class="post-comment">
                    <form action="{{URL::to('/update-comment/'.$edit_comment->post_id.'/'.$edit_comment->id)}}" method="post">
                        @csrf
                        <div class="input-group">
                          <input class="form-control" placeholder="Post a comment" type="text" name="content" value="{{ $edit_comment->content }}">
                          <button class="btn btn-primary ml-2" type="submit"><i class="fas fa-paper-plane"></i></button>
                        </div>
                      </form>
                  </div>
@endsection
