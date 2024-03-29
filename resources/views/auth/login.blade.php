<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="{{ url('/css/style.css') }}" />
</head>
<body>
    <section id="banner" style="background-image: url('images/bg/bg-1.jpg');">
      <div class="container text-light">
        <div class="row">
          <div class="col-4">
          </div>
          <div class="col-4">
            <div class="sign-up-form bg-primary" style="height: 500px;">
              <div class="col text-center">
                  <a href="index.html" class="logo"><img class="mt-2" src="{{url('images/logo.png')}}" alt="Friend Finder"/></a>
                </div>
              <h2 class="text-white text-center">Find My Friends</h2>
              <div class="form-wrapper border-top border-secondary" style="">
                <form action="{{ route('login') }}" method="post">
                  @csrf
                  <div class="form-group m-3">
                    <input type="email"name="email" class="form-control rounded" id="example-email" placeholder="Enter email">
                  </div>
                  <div class="form-group m-3">
                    <input type="password" name="password" class="form-control rounded" id="example-password" placeholder="Enter a password">
                  </div>
                  <div class="col text-center">
                    <button class="btn-dark rounded-pill">Signin</button>
                  </div>
                </form>
              </div>
              <div class="text-center">
                  <a class="text-light" href="{{ route('register') }}">Already have an account?</a>
              </div>
              <div class="text-center">
                  <a class="text-light" href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
              </div>
            </div><!-- Sign Up Form End -->
          </div>
          <div class="col-4">
          </div>
        </div>
      </div>
    </section>
    @extends('footer')
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://use.fontawesome.com/releases/v5.15.2/js/all.js"></script>
</body>
</html>
