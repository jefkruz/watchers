@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle" src="{{$member->image}}" alt="User profile picture">
                    </div>

                    <h3 class="profile-username text-center">{{$member->name}}</h3>

                    @if($isTeamHead)
                    <p class="text-muted text-center mb-0 bg-dark"><small class="text-warning">TEAM HEAD</small></p>
                    @endif

                    <p class="text-muted text-center"><small class="text-danger"> USERNAME: </small>{{$member->username}}</p>



                    @if(!$isTeamHead)
                    <button data-toggle="modal" data-target="#deptHeadModal" class="btn bg-success btn-block"><b>Set As TEAM HEAD</b> <i class="fa fa-person-chalkboard"></i></button>
                    @endif
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">FULL PROFILE</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>Full Name</label>
                                <input type="text" class="form-control" value="{{$member->name}}" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" class="form-control" placeholder="No username set" value="{{$member->username}}" disabled>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>Email Address</label>
                                <input type="email" class="form-control" value="{{$member->email}}" disabled>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <label> Phone Number</label>
                                <input type="text" class="form-control" placeholder="No phone number set" value="{{$member->phone}}" disabled>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>Birth Day</label>
                                <input type="text" class="form-control" value="{{$member->birth_date}}" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>Birth Month</label>
                                <input type="text" class="form-control" value="{{ date('F', mktime(0, 0, 0, $member->birth_month, 1)) }}" disabled>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>Church</label>
                                <input type="text" class="form-control" value="{{$member->church}}" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>Zone</label>
                                <input type="text"  class="form-control" value="{{$member->zone}}" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>Residential Address</label>
                                <textarea  class="form-control" rows="3" placeholder="" disabled>{{$member->address}}</textarea>

                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>City</label>
                                <input type="text"  class="form-control" value="{{$member->city}}" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>State</label>
                                <input type="text"  class="form-control" value="{{$member->state}}" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <label>Country</label>
                                <input type="text"  class="form-control" value="{{$member->country}}" disabled>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="deptHeadModal">

        <div class="modal-dialog modal-lg">
            <form class="modal-content" method="post" enctype="multipart/form-data" action="{{route('user.setTeamHead', $member->id)}}">

                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Set As Department Head</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 offset-md-3">
                                <button class="btn btn-app bg-success">
                                    <i class="fa fa-person-chalkboard fa-2x"></i>
                                    Add {{strtoupper($member->name)}} as Team Head
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.modal-content -->
            </form>
        </div>
        <!-- /.modal-dialog -->
    </div>


    @endsection

@section('style')
@endsection

@section('script')
@endsection
