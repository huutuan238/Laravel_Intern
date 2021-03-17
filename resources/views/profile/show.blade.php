@extends('welcome')

@section('content')
              <div class="about-profile" style="font-size: 20px;">
                <div class="about-content-block">
                  <h4 class="grey"><i class="ion-ios-briefcase-outline icon-in-title"></i>Use Profile</h4>
                  <div class="organization">
                    <div class="work-info">
                      <h5>Name</h5>
                      <h6 class="text-primary">{{ $user->name }}</h5>
                    </div>
                  </div>
                  <div class="organization">
                    <div class="work-info">
                      <h5>Email</h5>
                      <h6 class="text-primary">{{ $user->email }}</h5>
                    </div>
                  </div>
                  <div class="organization">
                    <div class="work-info">
                      <h5>Phone</h5>
                      <h6 class="text-primary">{{ $user->phone }}</h5>
                    </div>
                  </div>
                  <div class="organization">
                    <div class="work-info">
                      <h5>Image</h5>
                      <h6 class="text-primary">{{ $user->image }}</h5>
                    </div>
                  </div>
                  <div class="organization">
                    <div class="work-info">
                      <a class="text-grey" href="{{URL::to('/edit-profile/'.$user->id)}}">Edit</a>
                    </div>
                  </div>
                </div>
              </div>
@endsection
