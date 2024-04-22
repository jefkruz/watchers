@extends('layouts.main')



@section('content')

    @if ($video->count() < 1)
        <div class="alert alert-danger solid alert-dismissible fade show">
            <svg viewBox="0 0 24 24" width="24 " height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
            <strong>Sorry!</strong> No Uploaded Video.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
            </button>
        </div>
    @else
    <div class="row">
            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-6">
                <div class="card">
                    <div class="card-header">
                            <h5 class="card-title">{{$video->name}}</h5>
                    </div>


                    <div class="card-body">
                        <video id="video" class="video-js">
                            <source src="{{url($video->link)}}" type="video/mp4">
                        </video>

                    </div>

                </div>
            </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Comments</div>
                </div>
                <div class="card-body" id="commentList">
                    <div id="DZ_W_Todo3" class="widget-media dz-scroll height370 ps ps--active-y">
                        <ul class="timeline">
                            @foreach($video->comments() as $comment)
                                <li>
                                    <div class="timeline-panel">
                                        <div class="media me-2">
                                            <img alt="image" width="50" src="{{$comment->picture}}">
                                        </div>
                                        <div class="media-body">
                                            <h5 class="mb-1">{{$comment->name}} <small class="text-muted">{{$comment->created_at->diffForHumans()}}</small></h5>
                                            <p class="mb-1">{{$comment->comment}}</p>

                                        </div>

                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="card-footer">
                    <form method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">Commenting as {{session('user')->name}} ...</label>
                            <input type="text" name="comment" class="form-control" placeholder="Enter comment and press enter" required>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>
    @endif
@endsection

@section('styles')
    <link href="https://vjs.zencdn.net/8.3.0/video-js.css" rel="stylesheet" />
{{--    <style>--}}
{{--        .scrollable-div {--}}
{{--            /* Set a fixed height for the div */--}}
{{--            height: 300px; /* Adjust height as needed */--}}

{{--            /* Add overflow property to enable scrolling */--}}
{{--            overflow: auto;--}}
{{--        }--}}
{{--    </style>--}}
@endsection

@section('script')
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
    </script>
    <script>
        const ps5 = new PerfectScrollbar('#commentList', {
            useBothWheelAxes: true,
            suppressScrollX: true
        });
    </script>
@endsection

