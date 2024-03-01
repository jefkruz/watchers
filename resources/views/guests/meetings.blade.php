@extends('layouts.main')



@section('content')

    <div class="row">
        @foreach($meetings as $meeting)
            <div class="col-xl-3 col-lg-6 col-md-4 col-sm-6">
                <div class="card">
                    @if($meeting->image)

                        <img class="card-img-top img-fluid" src="{{url($meeting->image)}}" alt="{{$meeting->title}}">
                    @endif

                    <div class="card-header">
                        <h5 class="card-title">{{$meeting->title}}</h5>
                    </div>
                    <div class="card-body">
                        <div style="display: none" id="timerDisplay-{{$meeting->id}}" class="alert alert-danger text-center">
                            <p> <b>LIVE IN:</b></p>
                            <h3 id="timerText-{{$meeting->id}}" data-seconds="{{$meeting->startSeconds}}" data-timer="timerDisplay-{{$meeting->id}}" data-watch="meetingBtn-{{$meeting->id}}" class="timers">--:--:--</h3>
                        </div>

                        <a style="display: none" id="meetingBtn-{{$meeting->id}}" href="{{route('attendMeeting', $meeting->unique_code)}}" class="btn btn-primary btn-sm waves-effect waves-light"><i class="fa fa-tv"></i> Go To Meeting</a>

                    </div>
                </div>
            </div>

        @endforeach

    </div>
@endsection
@section('script')
    <script>
        const timers = $('.timers');
        for(let i = 0; i < timers.length; i++){
            const id = timers[i].id;
            const watchID = timers[i].dataset.watch;
            const timerID = timers[i].dataset.timer;
            const startSeconds = timers[i].dataset.seconds * 1000;

            let x = setInterval(function(){
                const now = new Date().getTime();
                const distance = startSeconds - now;

                if(distance > 0){
                    $('#' + timerID).show();
                }

                const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);
                const timer = days + 'd ' + hours + 'h ' + minutes + 'm ' + seconds + 's ';

                $('#' + id).html(timer);

                if(distance < 0){
                    clearInterval(x);
                    $('#' + timerID).hide();
                    $('#' + watchID).show();
                }
            }, 1000);
        }
    </script>
@endsection

