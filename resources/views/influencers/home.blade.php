@extends('layouts.main')


@section('datastyles')
    <link href="https://vjs.zencdn.net/8.3.0/video-js.css" rel="stylesheet" />
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

                                        <h4 class="card-intro-title mb-4">Video of the day</h4>
                                    <video id="video" class="video-js">
                                        <source src="{{url($video->link)}}" type="video/mp4">
                                    </video>

                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-xxl-12">
                            <div class="card">
                                <div class="card-body p-4">
                                    <h4 class="card-intro-title mb-4">Upcoming Ministry  Programmes</h4>
                                    @if ($meetings->count() < 1)
                                        <div class="alert alert-danger solid alert-dismissible fade show">
                                            <svg viewBox="0 0 24 24" width="24 " height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                                            <strong>Sorry!</strong> No Scheduled Programme Available.
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                                            </button>
                                        </div>
                                    @else
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

                                                            <a style="display: none" id="meetingBtn-{{$meeting->id}}" href="{{route('attendMeeting', $meeting->unique_code)}}" class="btn  btn-block btn-primary btn-sm waves-effect waves-light"><i class="fa fa-tv"></i> Go To Meeting</a>

                                                        </div>
                                                    </div>
                                                </div>

                                            @endforeach
                                        </div>
                                    @endif

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
                                         @if(session('user')->avatar != '')
                                            <img src="{{asset( 'avatar/'.session('user')->avatar)}}" width="100" class="img-fluid rounded-circle" alt=""/>
                                        @else
                                            <img src="{{asset( 'avatar/default.png')}}" width="100" class="img-fluid rounded-circle" alt=""/>
                                        @endif

									</span>
                                        <div class="media-body text-white">
                                            <p class="mb-1">Welcome</p>
                                            <h3 class="text-white"> {{ucwords(session('user')->name)}}</h3>
                                            <button class="badge" style="color: #b28c41"><i class="fa fa-crown" ></i> {{strtoupper(session('user')->level() . ' INFLUENCER')}}</button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-12 col-md-12">
                            <div class="items">
                                <div class="widget-stat card">
                                    <a href="{{route('referrals')}}">
                                        <div class="card-body p-4 bg-primary">
                                            <div class="media ai-icon">
									<span class="me-3 bgl-primary text-primary">
										<i class="fas fa-users"></i>

									</span>
                                                <div class="media-body">
                                                    <p class="mb-1 text-white">My Influencers</p>
                                                    <h4 class="mb-0 text-white">{{$referrals->count()}}</h4>
                                                    <span class="badge bg-primary float-end">VIEW</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="card-footer">

                                        <div class="row">
                                            <div class=" col-3">
                                                <a href="https://www.facebook.com/sharer/sharer.php?u={{url('register'.'/'.session('user')->username)}}" class="badge btn-facebook"><i class="fab fa-facebook-f"></i></a>

                                            </div>
                                            <div class=" col-3">
                                                <a href="https://twitter.com/intent/tweet?text=View+my+products&url={{url('register'.'/'.session('user')->username)}}" class="badge btn-twitter"><i class="fab fa-twitter"></i></a>

                                            </div>
                                            <div class="col-3">
                                                <a href="https://wa.me/?text={{url('register'.'/'.session('user')->username)}}" class="badge btn-whatsapp"><i class="fab fa-whatsapp"></i></a>

                                            </div>
                                            <div class=" col-3">
                                                <a href="https://telegram.me/share/url?url={{url('register'.'/'.session('user')->username)}}" class="badge btn-twitter"><i class="fab fa-telegram"></i></a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-12">
                            <div class="items">
                                <div class="widget-stat card">
                                    <a href="{{route('participants')}}">
                                        <div class="card-body p-4 btn-info" >
                                            <div class="media ai-icon">
									<span class="me-3 bgl-info text-info">
										<i class="fas fa-users"></i>

									</span>
                                                <div class="media-body">
                                                    <p class="mb-1 text-white">My Participants</p>
                                                    <h4 class="mb-0 text-white">{{$participants->count()}}</h4>
                                                    <span class="badge bg-info float-end">VIEW</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="card-footer">

                                        <div class="row">
                                            <div class=" col-3">
                                                <a href="https://www.facebook.com/sharer/sharer.php?u={{'thewatchersnetwork.org/'.session('user')->username}}" class="badge btn-facebook"><i class="fab fa-facebook-f"></i></a>

                                            </div>
                                            <div class=" col-3">
                                                <a href="https://twitter.com/intent/tweet?text=View+my+products&url={{'thewatchersnetwork.org/'.session('user')->username}}" class="badge btn-twitter"><i class="fab fa-twitter"></i></a>

                                            </div>
                                            <div class="col-3">
                                                <a href="https://wa.me/?text={{'thewatchersnetwork.org/'.session('user')->username}}" class="badge btn-whatsapp"><i class="fab fa-whatsapp"></i></a>

                                            </div>
                                            <div class=" col-3">
                                                <a href="https://telegram.me/share/url?url={{'thewatchersnetwork.org/'.session('user')->username}}" class="badge btn-twitter"><i class="fab fa-telegram"></i></a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-12">
                            <div class="items">
                                <div class="widget-stat card">
                                    <a href="{{route('downloadsCount')}}">
                                        <div class="card-body p-4 btn-danger" >
                                            <div class="media ai-icon">
									<span class="me-3 bgl-danger text-danger">
										<i class="fas fa-users"></i>

									</span>
                                                <div class="media-body">
                                                    <p class="mb-1 text-white">My Downloads</p>
                                                    <h4 class="mb-0 text-white">{{$myDownloads->count()}}</h4>
                                                    <span class="badge bg-danger float-end">VIEW</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>

                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-xl-8 ">
                    <div class="row">
                        <div class="card">
                            <div class="card-body p-4">
                                <h4 class="card-intro-title">Our Training  Courses</h4>
                            </div>
                        </div>


                        <div class="col-xl-4 col-lg-6 col-sm-6">
                            <a href="{{route('generalCourses')}}">
                                <div class="widget-stat card bg-primary">
                                    <div class="card-body  p-4">
                                        <div class="media">
									<span class="me-3">
										<i class="la la-graduation-cap"></i>
									</span>
                                            <div class="media-body text-white">
                                                <p class="mb-1">General Trainings</p>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>

                        </div>
                        <div class="col-xl-4 col-lg-6 col-sm-6">
                            <a href="{{route('subscriptionCourses')}}">
                                <div class="widget-stat card bg-warning">
                                    <div class="card-body  p-4">
                                        <div class="media">
									<span class="me-3">
										<i class="la la-dollar-sign"></i>
									</span>
                                            <div class="media-body text-white">
                                                <p class="mb-1">Paid Trainings</p>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>

                        </div>
                        <div class="col-xl-4 col-lg-6 col-sm-6">
                            <a href="{{route('certificationCourses')}}">
                            <div class="widget-stat card bg-success">
                                <div class="card-body  p-4">
                                    <div class="media">
									<span class="me-3">
										<i class="la la-certificate"></i>
									</span>
                                        <div class="media-body text-white">
                                            <p class="mb-1">Certificate Trainings</p>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            </a>
                        </div>
                    </div>

                    <div class="row">

                        <div class="card">
                            <div class="card-body p-4">
                                <h4 class="card-intro-title">Information Center</h4>
                            </div>
                        </div>
                        @foreach($resources as $post)
                            <div class="col-xl-4 col-lg-6 col-md-4 col-sm-6">
                                <a href="{{route('viewResource', [$post->id, $post->slug])}}">
                                    <div class="card">
                                        @if($post->image)

                                            <img class="card-img-top img-fluid" src="{{url($post->image)}}" alt="{{$post->title}}">
                                        @endif
                                        <div class="card-header">
                                            <h5 class="card-title">{{$post->title}}</h5>
                                        </div>
                                        <div class="card-body">
                                            <p>{!! html_entity_decode(Str::limit($post->content, 150)) !!}</p>

                                        </div>
                                        <div class="card-footer ">
                                            <div class="media mt-0">

                                                <div class="media-body">
                                                    <h6 class="mb-0 mt-2 ms-2"><i class="fa fa-clock"></i> {{$post->created_at->diffForHumans()}}</h6>
                                                </div>
                                                <div class="ms-auto">
                                                    <div class="d-flex mt-1">
                                                        <a class="new me-2 text-muted fs-16" href="JavaScript:void(0);"><span class=""><i class="fe fe-message-square"></i>{{$post->comments()->count()}}</span></a>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>

                            </div>
                        @endforeach
                        <div class="card-body p-4">

                            <div class="card house-bx">
                                <div class="card-body">
                                    <div class="media align-items-center">
                                        <svg width="88" height="85" viewBox="0 0 88 85" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M77.25 	30.8725V76.25H10.75V30.8725L44 8.70001L77.25 30.8725Z" fill="url(#paint0_linear)"/><path d="M2 76.25H86V85H2V76.25Z" fill="url(#paint1_linear)"/>	<path d="M21.25 39.5H42.25V76.25H21.25V39.5Z" fill="url(#paint2_linear)"/><path d="M52.75 39.5H66.75V64H52.75V39.5Z" fill="url(#paint3_linear)"/><path d="M87.9424 29.595L84.0574 35.405L43.9999 8.70005L3.94237 35.405L0.057373 29.595L43.9999 0.300049L87.9424 29.595Z" fill="url(#paint4_linear)"/><path d="M49.25 62.25H70.25V65.75H49.25V62.25Z" fill="url(#paint5_linear)"/>
                                            <path d="M52.75 50H66.75V53.5H52.75V50Z" fill="url(#paint6_linear)"/><path d="M28.25 57C28.25 57.4642 28.0656 57.9093 27.7374 58.2375C27.4092 58.5657 26.9641 58.75 26.5 58.75C26.0359 58.75 25.5908 58.5657 25.2626 58.2375C24.9344 57.9093 24.75 57.4642 24.75 57C24.75 56.5359 24.9344 56.0908 25.2626 55.7626C25.5908 55.4344 26.0359 55.25 26.5 55.25C26.9641 55.25 27.4092 55.4344 27.7374 55.7626C28.0656 56.0908 28.25 56.5359 28.25 57Z" fill="url(#paint7_linear)"/><defs><linearGradient id="paint0_linear" x1="19.255" y1="28.8075" x2="64.1075" y2="73.6775" gradientUnits="userSpaceOnUse"><stop offset="" stop-color="#F9F9DF"/><stop offset="1" stop-color="#B6BDC6"/></linearGradient><linearGradient id="paint1_linear" x1="2" y1="80.625" x2="86" y2="80.625" gradientUnits="userSpaceOnUse"><stop offset="" stop-color="#3C6DB0"/><stop offset="1" stop-color="#291F51"/></linearGradient><linearGradient id="paint2_linear" x1="22.9825" y1="40.6025" x2="37.8575" y2="69.915" gradientUnits="userSpaceOnUse"><stop offset="" stop-color="#F0CB49"/><stop offset="1" stop-color="#E17E43"/></linearGradient><linearGradient id="paint3_linear" x1="52.75" y1="51.75" x2="66.75" y2="51.75" gradientUnits="userSpaceOnUse"><stop offset="" stop-color="#7BC7E9"/><stop offset="1" stop-color="#3C6DB0"/></linearGradient><linearGradient id="paint4_linear" x1="0.057373" y1="17.8525" x2="87.9424" y2="17.8525" gradientUnits="userSpaceOnUse"><stop offset="" stop-color="#E17E43"/><stop offset="1" stop-color="#85152E"/></linearGradient><linearGradient id="paint5_linear" x1="784.25" y1="216.25" x2="1036.25" y2="216.25" gradientUnits="userSpaceOnUse"><stop offset="" stop-color="#3C6DB0"/><stop offset="1" stop-color="#291F51"/></linearGradient><linearGradient id="paint6_linear" x1="570.75" y1="179.5" x2="682.75" y2="179.5" gradientUnits="userSpaceOnUse"><stop offset="" stop-color="#3C6DB0"/><stop offset="1" stop-color="#291F51"/></linearGradient><linearGradient id="paint7_linear" x1="98.25" y1="195.25" x2="105.25" y2="195.25" gradientUnits="userSpaceOnUse"><stop offset="" stop-color="#E17E43"/><stop offset="1" stop-color="#85152E"/></linearGradient></defs>
                                        </svg>
                                        <div class="media-body">
{{--                                            <h4 class="fs-22 text-white">INFORMATION CENTER</h4>--}}
                                            <h5 class="mb-2 text-white"><b>Click here to get more information on the Watchers Network</b></h5>
                                            <a href="{{route('showResources')}}" class="btn btn-outline-light text-white mt-2 btn-lg btn-block" >
                                                KNOW MORE
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-body p-4">
                            <h4 class="card-intro-title mb-4"> LIVE PRAYERTHON</h4>
                            <div>
                                <video id="liveStream"  class="video-js vjs-default-skin">

                                </video>
                            </div>
                            <br>
                            <h4 class="card-intro-title mb-4">Below Are Your Recruitment Links</h4>
                            <div class="div mb-3">
                                <p hidden id="registration">{{url('register'.'/'.session('user')->username)}}</p>
                                <button class="btn bg-primary text-white btn-lg btn-block" onclick="copyToClipboard('Thanks','Registration Link has been copied','success','#registration')">
                                    <i class="fas fa-copy"></i> My Influencers Link
                                </button>
                            </div>
                             <div class="div mb-3">
                                                            <p hidden id="magazine">{{route('mag',session('user')->username)}}</p>
                                <button class="btn btn-primary btn-lg btn-block" onclick="copyToClipboard('Thanks',' Magazine Download Link has been copied','success','#magazine')">
                                    <i class="fas fa-download"></i> Magazine Download Link
                                </button>
                            </div>
                            <div class="div mb-3">
                                <p hidden id="participants" >{{url('signin'.'/'.session('user')->username)}}</p>
                                <button class="btn btn-warning btn-lg btn-block" onclick="copyToClipboard('Thanks','Participation Link has been copied','success','#participants')">
                                    <i class="fas fa-copy"></i> My Participation Link
                                </button>
                            </div>
                            <a href="{{route('testimony')}}" class="btn btn-info mt-3 text-white  btn-block" >
                               <i class="fas fa-volume-up"></i> Share Testimony
                            </a>
                            <a href="{{route('prayer')}}" class="btn btn-secondary mt-3 text-white  btn-block" >
                                <i class="fas fa-pray"></i> Prayer Request
                            </a>

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

    <script src="https://vjs.zencdn.net/8.3.0/video.min.js"></script>

    <script>

        const player = videojs('video', {
            controls: true,
            fluid: true,
            liveui: true
        });
        player.on('contextmenu', function (e) {
            // Prevent the default right-click context menu
            e.preventDefault();
        });


// LIVE STREAM SCRIPT



        let liveStream = videojs('liveStream', {
            controls: true,
            fluid: true,
            liveui: true
        });

            const stream = '{{$stream->link}}';

            const parts = stream.split('.');
            const live = parts[parts.length - 1];

            const format = (live === 'm3u8') ? 'application/x-mpegURL' : 'video/mp4';

            liveStream.src({
                src: '{{$stream->link}}',
                type: format
            });

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
