@extends('layouts.admin')

@section('content')
    <div class="row">

        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{$meetings}}</h3>

                    <p> Programmes</p>
                </div>
                <div class="icon">
                    <i class="fa fa-tv"></i>
                </div>
                <a href="{{route('meetings.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{$participants}}</h3>

                    <p>Participants</p>
                </div>
                <div class="icon">
                    <i class="fa fa-users"></i>
                </div>
                <a href="{{route('guests.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{$staffs}}</h3>

                    <p>Influencers</p>
                </div>
                <div class="icon">
                    <i class="fa fa-users"></i>
                </div>
                <a href="{{route('staff.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-gradient-orange text-white">
                <div class="inner">
                    <h3>{{$teamHeads}}</h3>

                    <p >Team Heads</p>
                </div>
                <div class="icon">
                    <i class="fa fa-person-chalkboard"></i>
                </div>
                <a href="{{route('user.teamHeads')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-blue">
                <div class="inner">
                    <h3>{{$posts}}</h3>

                    <p>Posts</p>
                </div>
                <div class="icon">
                    <i class="fa fa-newspaper"></i>
                </div>
                <a href="{{route('resources.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>


        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-purple">
                <div class="inner">
                    <h3>{{$trainings}}</h3>

                    <p>Trainings</p>
                </div>
                <div class="icon">
                    <i class="fa fa-graduation-cap"></i>
                </div>
                <a href="{{route('courses.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-pink">
                <div class="inner">
                    <h3>{{$slides}}</h3>

                    <p>Slides</p>
                </div>
                <div class="icon">
                    <i class="fa fa-image"></i>
                </div>
                <a href="{{route('slides.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>



        <div class="col-lg-3 col-md-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{$birthdays->count()}}</h3>

                    <p>{{date('F')}} Birthdays</p>
                </div>
                <div class="icon">
                    <i class="fas fa-birthday-cake "></i>
                </div>
                <a href="{{route('birthdays')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <!-- small box -->
            <div class="small-box bg-gradient-maroon">
                <div class="inner">
                    <h3>{{$camps}}</h3>

                    <p>Campus Zones</p>
                </div>
                <div class="icon">
                    <i class="fas fa-globe"></i>
                </div>
                <a href="{{route('campus.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <!-- small box -->
            <div class="small-box bg-gradient-fuchsia">
                <div class="inner">
                    <h3>{{$zones}}</h3>

                    <p>Church Zones</p>
                </div>
                <div class="icon">
                    <i class="fas fa-globe"></i>
                </div>
                <a href="{{route('zone.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-gradient-blue">
                <div class="inner">
                    <h3>{{$magazines}}</h3>

                    <p>Magazines</p>
                </div>
                <div class="icon">
                    <i class="fa fa-file-pdf"></i>
                </div>
                <a href="{{route('magazines.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

    </div>
    @endsection

@section('style')
@endsection

@section('script')
@endsection
