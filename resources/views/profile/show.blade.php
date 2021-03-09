@extends('welcome')

@section('content')
              <div class="about-profile" style="font-size: 20px;">
                <div class="about-content-block">
                  <h4 class="grey"><i class="ion-ios-briefcase-outline icon-in-title"></i>Use Profile</h4>
                  <div class="organization">
                    <div class="work-info">
                      <h5>Name</h5>
                      <span class="text-grey">{{ $user->name }}</span>
                    </div>
                  </div>
                  <div class="organization">
                    <div class="work-info">
                      <h5>Email</h5>
                      <span class="text-grey">{{ $user->email }}</span>
                    </div>
                  </div>
                  <div class="organization">
                    <div class="work-info">
                      <h5>Phone</h5>
                      <span class="text-grey">{{ $user->phone }}</span>
                    </div>
                  </div>
                  <div class="organization">
                    <div class="work-info">
                      <h5>Image</h5>
                      <span class="text-grey">{{ $user->image }}</span>
                    </div>
                  </div>
                  <div class="organization">
                    <div class="work-info">
                      <a class="text-grey" href="{{URL::to('/edit-profile/'.$user->id)}}">Edit</a>
                      <!-- <span class="text-grey">{{ $user->name }}</span> -->
                    </div>
                  </div>
                </div>
              </div>
@endsection
