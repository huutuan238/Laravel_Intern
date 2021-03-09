@extends('welcome')

@section('content')
              <div class="about-profile" style="font-size: 20px;height: 200px;">
                <form action="{{ URL::to('/update-profile/'.$user->id) }}" method="post" style="height: 200px;">
                  @csrf
                  <div class="about-content-block">
                    <h4 class="grey"><i class="ion-ios-briefcase-outline icon-in-title"></i>Update Profile</h4>
                    <div class="organization">
                      <div class="work-info">
                        <h5>Name</h5>
                        <input style="width:95%;"  type="text" value="{{ $user->name }}" name="name" class="text-grey">
                      </div>
                    </div>
                    <div class="organization">
                      <div class="work-info">
                        <h5>Email</h5>
                        <input style="width:95%;" type="text" value="{{ $user->email }}" name="email" class="text-grey">
                      </div>
                    </div>
                    <div class="organization">
                      <div class="work-info">
                        <h5>Phone</h5>
                        <input style="width:95%;" type="text" value="{{ $user->phone }}" name="phone" class="text-grey">
                      </div>
                    </div><div class="organization">
                      <div class="work-info">
                        <h5>Image</h5>
                        <input style="width:95%;"type="text" value="{{ $user->image }}" name="image" class="text-grey">
                      </div>
                    </div>
                    <input class="btn btn-primary pull-right" type="submit" name="submit">
                  </div>
                </form>
              </div>
@endsection
