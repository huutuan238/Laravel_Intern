<!DOCTYPE html>
<html>
<head>
  <title>LayOut</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="{{ url('/css/style.css') }}" />
</head>
<body>
  <header>
    <div class="container bg-dark text-white">
      <div class="row">
        <div class="col-sm-3">
          <nav class="navbar">
            <a class="navbar-brand" href="{{ URL::to('home') }}">
              <img src="{{asset('images/logo.png')}}" alt="Logo">
            </a>
          </nav>
        </div>
        <div class="col-sm-4">
          <nav class="navbar">
            <form class="form-inline m-2" action="/search" method="get">
              @csrf
              <div class="form-group">
                <input class="form-control" type="text" name="search" placeholder="search">
                <button class="btn btn-success" type="submit"><i class="fas fa-search"></i></button>
              </div>
            </form>
          </nav>
        </div>
        <div class="col-sm-5 col-md-5">
          <nav class="navbar navbar-expand-sm bg-dark navbar-dark ">
            <ul class="nav justify-content-center">
              <li class="nav-item p-2">
                <a class="nav-link" href="{{ URL::to('home') }}"><span class="glyphicon glyphicon-home text-light"></span>Home</a>
              </li>
              <li class="nav-item p-2">
                <a  class="nav-link" href="{{ URL::to('profile/'.$user->id)}}">Profile</a>
              </li>
              <li class="nav-item p-2">
                <a  class="nav-link" href="{{ URL::to('my-post/'.$user->id)}}">MyPost</a>
              </li>
              <!-- <li class="nav-item dropdown dropdown-notifications">
                  <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                      Notification<span class="caret"></span>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right menu-notification" aria-labelledby="navbarDropdown">
                      @foreach (Auth::user()->notifications as $notification)
                          <a class="dropdown-item" href="{{ URL::to('post/'.$notification->data['post_id']) }}">
                              <span>{{ $notification->data['user'].' da cmt bai cua ban' }}</span><br>
                          </a>
                      @endforeach
                  </div>
              </li> -->
              <li class="nav-item p-2">
                <a  class="nav-link" href="{{ route('logout')}}">Logout</a>
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </header>
  <div class="container">
    <div class="content">
      <div class="row">
          <div class="col-md-3 position-static">
            <div class="profile">
              <a href="{{ URL::to('profile/'.$user->id)}}">
                <div class="row bg-primary">
                  <div class="col-md-4">
                    <img class="rounded-circle" src="{{asset('images/users/user-1.jpg')}}" alt="user" width="80px">
                  </div>
                  <div class="col-md-8">
                    <h5 class="text-light">{{ $user->name }}</h5>
                  </div>
                </div>
              </a>
            </div>
          </div>
        <div class="col-md-6">
          @yield('content')
        </div>
        <div class="col-md-3">
              <div class="row">
                <div class="col-sm-4 col-md-4">
                  <img class="rounded-circle " src="{{asset('images/users/user-1.jpg')}}" alt="user" width="40px">
                </div>
                <div class="col-sm-8 col-md-8">
                  <div><a href=""><h5 class="text-primary">Name</h5></a></div>
                  <div><a href=""><h6 class="text-success">Add friend</h6></a></div>

                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @extends('footer')
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://use.fontawesome.com/releases/v5.15.2/js/all.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<!-- <script src="https://js.pusher.com/4.4/pusher.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script type="text/javascript">
    var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
        encrypted: true,
        cluster: "ap1"
    });
    var channel = pusher.subscribe('NotificationEvent');
    channel.bind('send-message', function(data) {
        var newNotificationHtml = `
        <a class="dropdown-item" href="{{ URL::to('post/'.'data.post_id') }}">
          <span>${data.user} da cmt bai cua ban</span><br>
        </a>
        `;

        $('.menu-notification').prepend(newNotificationHtml);
    });
</script> -->
</body>
</html>
