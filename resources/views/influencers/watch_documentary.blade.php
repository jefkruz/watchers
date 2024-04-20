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
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                <div class="card border-0 pb-0">
                    <div class="card-header border-0 pb-0">
                        <h4 class="card-title">Comments</h4>
                    </div>
                    <div class="card-body">
                        <div id="DZ_W_Todo3" class="widget-media dz-scroll height370 ps ps--active-y">
                            <ul class="timeline">
                                <li>
                                    <div class="timeline-panel">
                                        <div class="media me-2">
                                            <img alt="image" width="50" src="images/avatar/1.jpg">
                                        </div>
                                        <div class="media-body">
                                            <h5 class="mb-1">Alfie Mason <small class="text-muted">29 July 2020</small></h5>
                                            <p class="mb-1">I shared this on my fb wall a few months back..</p>
                                            <a href="#" class="btn btn-primary btn-xxs shadow">Reply</a>
                                            <a href="#" class="btn btn-outline-danger btn-xxs">Delete</a>
                                        </div>
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-primary light sharp" data-bs-toggle="dropdown">
                                                <svg width="18px" height="18px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="#">Edit</a>
                                                <a class="dropdown-item" href="#">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="timeline-panel">
                                        <div class="media me-2 media-info">
                                            KG
                                        </div>
                                        <div class="media-body">
                                            <h5 class="mb-1">Jacob Tucker <small class="text-muted">29 July 2020</small></h5>
                                            <p class="mb-1">I shared this on my fb wall a few months back..</p>
                                            <a href="#" class="btn btn-primary btn-xxs shadow">Reply</a>
                                            <a href="#" class="btn btn-outline-danger btn-xxs">Delete</a>
                                        </div>
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-info light sharp" data-bs-toggle="dropdown">
                                                <svg width="18px" height="18px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="#">Edit</a>
                                                <a class="dropdown-item" href="#">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="timeline-panel">
                                        <div class="media me-2 media-success">
                                            <img alt="image" width="50" src="images/avatar/2.jpg">
                                        </div>
                                        <div class="media-body">
                                            <h5 class="mb-1">Jack Ronan <small class="text-muted">29 July 2020</small></h5>
                                            <p class="mb-1">I shared this on my fb wall a few months back..</p>
                                            <a href="#" class="btn btn-primary btn-xxs shadow">Reply</a>
                                            <a href="#" class="btn btn-outline-danger btn-xxs">Delete</a>
                                        </div>
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-success light sharp" data-bs-toggle="dropdown">
                                                <svg width="18px" height="18px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="#">Edit</a>
                                                <a class="dropdown-item" href="#">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="timeline-panel">
                                        <div class="media me-2">
                                            <img alt="image" width="50" src="images/avatar/1.jpg">
                                        </div>
                                        <div class="media-body">
                                            <h5 class="mb-1">Noah Baldon <small class="text-muted">29 July 2020</small></h5>
                                            <p class="mb-1">I shared this on my fb wall a few months back..</p>
                                            <a href="#" class="btn btn-primary btn-xxs shadow">Reply</a>
                                            <a href="#" class="btn btn-outline-danger btn-xxs">Delete</a>
                                        </div>
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-primary light sharp" data-bs-toggle="dropdown">
                                                <svg width="18px" height="18px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="#">Edit</a>
                                                <a class="dropdown-item" href="#">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="timeline-panel">
                                        <div class="media me-2 media-danger">
                                            PU
                                        </div>
                                        <div class="media-body">
                                            <h5 class="mb-1">Thomas Grady  <small class="text-muted">02:26 PM</small></h5>
                                            <p class="mb-1">I shared this on my fb wall a few months back..</p>
                                            <a href="#" class="btn btn-primary btn-xxs shadow">Reply</a>
                                            <a href="#" class="btn btn-outline-danger btn-xxs">Delete</a>
                                        </div>
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-danger light sharp" data-bs-toggle="dropdown">
                                                <svg width="18px" height="18px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="#">Edit</a>
                                                <a class="dropdown-item" href="#">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="timeline-panel">
                                        <div class="media me-2 media-primary">
                                            <img alt="image" width="50" src="images/avatar/3.jpg">
                                        </div>
                                        <div class="media-body">
                                            <h5 class="mb-1">Oscar Weston  <small class="text-muted">29 July 2020</small></h5>
                                            <p class="mb-1">I shared this on my fb wall a few months back..</p>
                                            <a href="#" class="btn btn-primary btn-xxs shadow">Reply</a>
                                            <a href="#" class="btn btn-outline-danger btn-xxs">Delete</a>
                                        </div>
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-primary light sharp" data-bs-toggle="dropdown">
                                                <svg width="18px" height="18px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="#">Edit</a>
                                                <a class="dropdown-item" href="#">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; height: 370px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 185px;"></div></div></div>
                    </div>
                </div>
            </div>


    </div>
    @endif
@endsection

@section('styles')
    <link href="https://vjs.zencdn.net/8.3.0/video-js.css" rel="stylesheet" />
    <style>
        .scrollable-div {
            /* Set a fixed height for the div */
            height: 300px; /* Adjust height as needed */

            /* Add overflow property to enable scrolling */
            overflow: auto;
        }
    </style>
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

