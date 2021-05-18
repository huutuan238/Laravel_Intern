@foreach($post as $posts)
<div>
   <h2>{{ $posts->user->name }}</h2>
   <h2>{{ $posts->content }}</h2>
</div>
@endforeach
