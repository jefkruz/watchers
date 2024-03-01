@extends('layouts.main')



@section('content')
    @if ($courses->count() < 1)
        <div class="alert alert-danger solid alert-dismissible fade show">
            <svg viewBox="0 0 24 24" width="24 " height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
            <strong>Sorry!</strong> No Training Courses Available in this Category.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
            </button>
        </div>
    @else
    <div class="row">
        @foreach($courses as $course)
            <div class="col-xl-3 col-lg-6 col-md-4 col-sm-6">
                <div class="card">
                    @if($course->thumbnail)

                        <img class="card-img-top img-fluid" src="{{url($course->thumbnail)}}" alt="{{$course->title}}">
                    @endif

                    <div class="card-header">
                        <h5 class="card-title">{{$course->title}}</h5>
                    </div>
                    <div class="card-body">
                     <b>  <small class="text-danger">TRAINING TYPE:</small> {{strtoupper($course->course_type)}} COURSE<br></b>

                        @if($course->course_type == 'free')
                            <br>

                        @else
                            <small class="text-primary">USD Price:</small> $ {{number_format($course->course_fee_dollar, 2)}}<br>
                            <small class="text-primary">Naira Price:</small> N {{number_format($course->course_fee_naira, 2)}}<br>
                        @endif
                        @if($course->purchased())
                            <div class="row">
                                <div class="col-xl-6">
                                    <button disabled class="btn btn-outline-dark btn-sm waves-effect waves-light"><i class="fa fa-check"></i> PURCHASED</button>
                                </div>
                                <div class="col-xl-6">
                                    <a href="{{route('viewCourse', $course->id)}}" class="btn btn-primary btn-sm waves-effect waves-light ">PLAY COURSE <i class="fa fa-arrow-right"></i></a>
                                </div>
                            </div>
                        @else
                            <a href="{{route('previewCourse', $course->id)}}" class="btn btn-primary btn-sm waves-effect waves-light pull-right"><i class="fa fa-tv"></i> Preview</a>
                        @endif

{{--                        <a style="display: none" id="meetingBtn-{{$meeting->id}}" href="{{route('attendMeeting', $meeting->unique_code)}}" class="btn btn-primary btn-sm waves-effect waves-light"><i class="fa fa-tv"></i> Go To Meeting</a>--}}

                    </div>
                </div>
            </div>

        @endforeach

    </div>
    @endif
@endsection
@section('script')

@endsection

