@extends('layouts.plain')



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
                    <form method="post" action="{{route('addDocumentaryComment')}}">
                        @csrf

                         <input type="hidden" name="id" value="{{$video->id}}">
                         <input type="hidden" name="slug" value="{{$video->slug}}">
                            <div class="form-group">
                                <label class="mb-1"><strong>Full Name<span class="text-danger">*</span></strong></label>
                                <input type="text" class="form-control" name="name"  required >

                            </div>

                            <div class="form-group">
                                <label class="mb-1"><strong>Comment<span class="text-danger">*</span></strong></label>
                                <textarea class="form-control" name="comment"  required rows="4" ></textarea>

                            </div>


                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-primary btn-block">SUBMIT</button>
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
@endsection

