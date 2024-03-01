@extends('layouts.guest')


@section('datastyles')
    <link href="https://unpkg.com/video.js/dist/video-js.css" rel="stylesheet">
@endsection

@section('content')


            <!-- row -->
            <div class="col-xl-12 col-xxl-12">
                <div class="card">
                    <div class="card">
                        <div class="card-body p-4">


                            <div class="bootstrap-carousel">
                                <div id="carouselExampleIndicators2" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-indicators">
                                        @foreach ($slides as $index => $slide)
                                            <button type="button" data-bs-target="#carouselExampleIndicators2" data-bs-slide-to="{{ $index }}" {{ $index == 0 ? 'class=active' : '' }} aria-label="Slide {{ $index + 1 }}"></button>
                                        @endforeach
                                    </div>
                                    <div class="carousel-inner">
                                        @foreach ($slides as $index => $slide)
                                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">

                                                <img class="d-block w-100" src="{{ url($slide->photo) }}" alt="Slide {{ $index + 1 }}">
                                            </div>
                                        @endforeach

                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators2" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators2" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-8">
                    <div class="row">

                        <div class="col-xl-12 col-xxl-12">
                            <div class="card">
                                <div class="card-body p-4">
                                        <h4 class="card-intro-title mb-4">Upcoming Ministry  Programs</h4>

                                        <div class="row">
                                            @foreach($meetings as $meeting)
                                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
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

                                                            <a style="display: none" id="meetingBtn-{{$meeting->id}}" href="{{route('attendGuestsMeeting', $meeting->unique_code)}}" class="btn  btn-block btn-primary btn-sm waves-effect waves-light"><i class="fa fa-tv"></i> Go To Meeting</a>

                                                        </div>
                                                    </div>
                                                </div>

                                            @endforeach
                                        </div>


                                    </div>
                            </div>
                        </div>


                    </div>
                </div>

                <div class="col-xl-4 col-lg-12 col-sm-12">

                    <div class="row">

                        <div class="col-xl-12 col-md-12">
                            <div class=" card" style="background-color: #b28c41">
                                <div class="card-body  p-4">
                                    <div class="media">
									<span class="me-3">

                                            <img src="{{asset( 'avatar/default.png')}}" width="100" class="img-fluid rounded-circle" alt=""/>


									</span>
                                        <div class="media-body text-white">
                                            <p class="mb-1">Welcome</p>
                                            <h3 class="text-white"> {{ucwords(session('guest')->name)}}</h3>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="{{route('guestTestimony')}}" class="btn btn-info mt-3 text-white  btn-block" >
                            <i class="fas fa-volume-up"></i> Share Testimony
                        </a>
                        <a href="{{route('guestPrayer')}}" class="btn btn-secondary mt-3 text-white  btn-block" >
                            <i class="fas fa-pray"></i> Prayer Request
                        </a>

                    </div>

                </div>
            </div>

            </div>
        </div>
    </div>
    <!--**********************************
        Content body end
    ***********************************-->



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
@section('datascripts')

    <script src="https://unpkg.com/video.js/dist/video.js"></script>

    <script>


        function carouselReview(){
            /*  testimonial one function by = owl.carousel.js */
            jQuery('.testimonial-one').owlCarousel({
                loop:true,
                autoplay:true,
                margin:0,
                nav:true,
                dots: false,
                navText: ['<i class="las la-long-arrow-alt-left"></i>', '<i class="las la-long-arrow-alt-right"></i>'],
                responsive:{
                    0:{
                        items:1
                    },

                    480:{
                        items:1
                    },

                    767:{
                        items:1
                    },
                    1000:{
                        items:1
                    }
                }
            })
            /*Custom Navigation work*/
            jQuery('#next-slide').on('click', function(){
                $('.testimonial-one').trigger('next.owl.carousel');
            });

            jQuery('#prev-slide').on('click', function(){
                $('.testimonial-one').trigger('prev.owl.carousel');
            });
            /*Custom Navigation work*/
        }

        jQuery(window).on('load',function(){
            setTimeout(function(){
                carouselReview();
            }, 1000);
        });
    </script>


    @endsection
