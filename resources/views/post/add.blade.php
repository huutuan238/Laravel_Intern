@extends('layouts.app')

@section('content')
  <h3>this is add post page</h3>
  <form action="{{URL::to('/save-post')}}" method="post">
    @csrf
    <div>
        <textarea name="content" placeholder="Write what you wish"></textarea>
        <label for="inputSuccess">Hiển thị</label>
        <select name="status">
              <option value="0">Ẩn</option>
              <option value="1">Hiện</option>
        </select>

        <input type="submit" value="Submit">
    </div>
  </form>
@endsection
