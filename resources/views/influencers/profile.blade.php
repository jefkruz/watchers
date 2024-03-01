@extends('layouts.main')

@section('content')

    <!--**********************************
            Content body start
        ***********************************-->
    <div class="row">
        <div class="col-lg-12">
            <div class="profile card card-body px-3 pt-3 pb-0">
                <div class="profile-head">
                    <div class="photo-content">
                        <div class="cover-photo rounded"></div>
                    </div>
                    <div class="profile-info">
                        <div class="profile-photo">
                            <img src="{{asset( session('user.image'))??'avatar/default.png'}}" class="img-fluid rounded-circle" alt="">
                        </div>
                        <div class="profile-details">
                            <div class="profile-name px-3 pt-2">
                                <h4 class="text-primary mb-0">{{ucwords(session('user.name'))}}</h4>
                                <p>INFLUENCER</p>
                            </div>
                            <div class="profile-email px-2 pt-2">
                                <h4 class="text-muted mb-0">{{ucwords(session('user.email'))}}</h4>
                                <p>Email</p>
                            </div>
                            <div class="dropdown ms-auto">
                                <a href="#" class="btn btn-primary light sharp" data-bs-toggle="dropdown" aria-expanded="true"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li class="dropdown-item">
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#basicModal"> Update Image</button>

                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-4">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card overflow-hidden">

                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between"><span class="mb-0">My Team</span> <span class="badge badge-rounded badge-primary "><strong >{{$referrals->count()}}	</strong></span></li>
                            <li class="list-group-item d-flex justify-content-between"><span class="mb-0">Uplines Name:</span> 		<strong class="text-danger" >{{$upline->name?? 'Self'}}</strong></li>
                            {{--                            <li class="list-group-item d-flex justify-content-between"><span class="mb-0">Uplines Phone :</span> 		<strong ><a  class="text-danger" href="tel:{{$upline->phone}}">{{$upline->phone?? 'Self'}}</a> 	</strong></li>--}}

                        </ul>
                        <div class="card-footer border-0 mt-0">
                            <div class="div mb-3">
                                <p hidden id="registration">{{url('register'.'/'.session('user')->username)}}</p>
                                <button class="btn btn-primary text-white btn-lg btn-block" onclick="copyToClipboard('Thanks','Registration Link has been copied','success','#registration')">
                                    <i class="fas fa-copy"></i> My Influencers Link
                                </button>
                            </div>
                            <div class="div mb-3">
                                <p hidden id="participants" >{{url('signin'.'/'.session('user')->username)}}</p>
                                <button class="btn btn-warning btn-lg btn-block" onclick="copyToClipboard('Thanks','Participation Link has been copied','success','#participants')">
                                    <i class="fas fa-copy"></i> My Participant Link
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="profile-blog">
                                <h4><a href="#" class="text-danger">About The Watchers</a></h4>
                                <p class="mb-0">The Watchers Influencers Network</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-xl-8">
            <div class="card">

                <div class="card-body">
                    <div class="profile-tab">
                        <div class="custom-tab-1">
                            <ul class="nav nav-tabs">
                                <li class="nav-item"><a href="#my-posts" data-bs-toggle="tab" class="nav-link active show">Edit</a>
                                </li>
                                <li class="nav-item"><a href="#about-me" data-bs-toggle="tab" class="nav-link">Notification</a>
                                </li>
                                <li class="nav-item"><a href="#profile-settings" data-bs-toggle="tab" class="nav-link">Setting</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div id="my-posts" class="tab-pane fade active show">
                                    <div class="pt-3">
                                        <div class="settings-form">
                                            @include('includes.main.alerts')
                                            <h4 class="text-primary">Update Account</h4>
                                              <form id="profileForm" method="post" action="{{route('updateProfile')}}">
                                            @csrf
                                            @method('PATCH')
                                                <input type="hidden" name="id" value="{{$user->id}}">

                                                <div class="mb-3">
                                                    <label class="form-label">Full Name</label>
                                                    <input type="text" value="{{$user->name}}"  name="name" class="form-control">
                                                </div>
                                                <div class="row">
                                                    <div class="mb-3 col-md-6">
                                                        <label class="form-label">Email</label>
                                                        <input type="email" value="{{$user->email}}" readonly name="email" class="form-control">
                                                    </div>
                                                    <div class="mb-3 col-md-6">
                                                        <label class="form-label">Username</label>
                                                        <input type="text" value="{{$user->username}}" disabled name="username" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Phone Number</label>
                                                    <input type="text"  inputmode="tel" name="phone" class="form-control" value="{{$user->phone}}">
                                                </div>
                                                <div class="row">
                                                    <div class="mb-3 col-md-6">
                                                        <label class="form-label">Day</label>
                                                        <select name="birth_date" class="form-control" required>
                                                            @if ($user->birth_date)
                                                                <option value="{{$user->birth_date }}">{{ $user->birth_date }}</option>
                                                            @endif

                                                            @for ($i = 1; $i <= 31; $i++)
                                                                <option value="{{ $i }}">{{ $i }}</option>
                                                            @endfor
                                                        </select>

                                                    </div>
                                                    <div class="mb-3 col-md-6">
                                                        <label class="form-label">Month</label>
                                                        <select class="form-control default-select wide"  name="birth_month"  required>
                                                            @if ($user->birth_month)
                                                                <option value="{{ $user->birth_month }}">{{ date('F', mktime(0, 0, 0, $user->birth_month, 1)) }}</option>
                                                            @endif

                                                            @for ($i = 1; $i <= 12; $i++)
                                                                <option value="{{ $i }}">{{ date('F', mktime(0, 0, 0, $i, 1)) }}</option>
                                                            @endfor

                                                        </select>
                                                    </div>

                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Address </label>
                                                    <textarea class="form-control"  name="address"  placeholder="Enter Address"> {{$user->address}}</textarea>
                                                </div>
                                                <div class="row">
                                                    <div class="mb-3 col-md-6">
                                                        <label class="form-label">City</label>
                                                        <input type="text" name="city" value=" {{$user->city}}" placeholder="Enter City" class="form-control">
                                                    </div>
                                                    <div class="mb-3 col-md-6">
                                                        <label class="form-label">Gender</label>
                                                        <select class="form-control default-select wide" name="gender" required>
                                                            @if($user->gender)
                                                            <option value="{{$user->gender}}">{{$user->gender}}</option>
                                                            @endif
                                                            <option value="Male">Male</option>
                                                            <option value="Female">Female</option>

                                                        </select>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="mb-3 col-md-6">
                                                        <label class="form-label">State</label>
                                                        <input type="text" name="state" value=" {{$user->state}}" placeholder="Enter State" class="form-control">
                                                    </div>
                                                    <div class="mb-3 col-md-6">
                                                        <label class="form-label">Country</label>
                                                        <select class="form-control default-select wide" name="country" required>
                                                            @if($user->country)
                                                            <option value="{{$user->country}}">{{$user->country}}</option>
                                                            @endif
                                                            @foreach($countries as $country)
                                                                <option value="{{$country->name}}">{{$country->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                </div>
                                                <hr>
                                                <h4 >Church Information</h4>
                                                  <div class="row">
                                                      <div class="mb-3 col-md-6">
                                                          <label class="form-label">Church</label>
                                                          <input type="text"  class="form-control" value=" {{$user->church}}"  name="church" placeholder="Enter Church Name ">
                                                      </div>
                                                      <div class="mb-3 col-md-6">
                                                          <label class="form-label">Campus</label>
                                                          <select class="form-control default-select wide" name="campus" required>
                                                              @if($user->campus)
                                                                  <option value="{{$user->campus}}">{{$user->campus}}</option>
                                                              @endif
                                                                  <option value="Not Applicable">Not Applicable</option>
                                                              @foreach($camps as $camp)
                                                                  <option value="{{$camp->name}}">{{$camp->name}}</option>
                                                              @endforeach
                                                          </select>
                                                      </div>
                                                      <div class="mb-3 ">
                                                          <label class="form-label">Zone</label>
                                                          <select class="form-control default-select wide" name="zone" required>
                                                              @if($user->zone)
                                                                  <option value="{{$user->zone}}">{{$user->zone}}</option>
                                                              @endif
                                                                  <option value="Not Applicable">Not Applicable</option>
                                                              @foreach($zones as $zone)
                                                                  <option value="{{$zone->name}}">{{$zone->name}}</option>
                                                              @endforeach
                                                          </select>
                                                      </div>

                                                  </div>


                                                <button class="btn btn-primary" type="submit">Update</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div id="about-me" class="tab-pane fade">
                                    <div class="card">
                                        <div class="card-header border-0 pb-0">
                                            <h4 class="card-title">My Notifications</h4>
                                        </div>
                                        <div class="card-body">
                                            <div id="DZ_W_TimeLine11" class="widget-timeline dz-scroll style-1 height370 ps ps--active-y">
                                                <ul class="timeline">
                                                    <li>
                                                        <div class="timeline-badge primary"></div>
                                                        <a class="timeline-panel text-muted" href="#">
                                                            <span> {{date('jS F, Y ', strtotime(session('user')->created_at)) }}</span>
                                                            <h6 class="mb-0">Welcome! <strong class="text-danger">{{ucwords(session('user')->name)}}</strong> joined YLWSIN.</h6>
                                                            <p class="mb-0"><i class="far fa-clock"></i>  {{session('user')->created_at->diffForHumans()}}</p>

                                                        </a>
                                                    </li>

                                                </ul>
                                                <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; height: 370px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 325px;"></div></div></div>
                                        </div>
                                    </div>
                                </div>
                                <div id="profile-settings" class="tab-pane fade">

                                </div>
                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="basicModal">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Modal title</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                                        </button>
                                    </div>
                                    <div class="modal-body">
{{--                                        <form  method="post" enctype="multipart/form-data" action="{{ route('updateimage', [Auth::user()->id])}}">--}}
                                            @csrf
                                            @method('PUT')
                                            <div class="input-group custom_file_input">
                                                <div class="form-file">
                                                    <input type="file" name="avatar"  required class="form-file-input form-control">
                                                </div>
                                            </div>


                                            <button type="submit" class="btn btn-primary mt-2">Save</button>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--**********************************
        Content body end
    ***********************************-->
    <script>
        function copyToClipboard(h1,h5,animicon,element) {
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val($(element).text()).select();
            document.execCommand("copy");
            $temp.remove();
            /*sweet allert*/
            Swal.fire(
                h1,
                h5,
                animicon
            )
        }
    </script>
@endsection
