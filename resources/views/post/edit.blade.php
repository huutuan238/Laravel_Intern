@extends('layouts.app')

@section('content')
  <h3>this is edit post page</h3>
  <form action="{{URL::to('/update-post/'.$edit_post->id)}}" method="post">
    @csrf
    <div>
        <textarea name="content" placeholder="Write what you wish">{{$edit_post->content}}</textarea>
        <label for="inputSuccess">Hiển thị</label>
        <select name="status">
              <option value="0">Ẩn</option>
              <option value="1">Hiện</option>
        </select>

        <input type="submit" value="Update">
    </div>
  </form>
@endsection
