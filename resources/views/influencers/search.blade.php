@extends('layouts.main')



@section('content')
{{--    @if ($videos->count() ==0 && $posts->count() == 0)--}}

        @if($videos)
            <div class="row">
                <h3 class="card-title mb-5">Video {{$page_title}}</h3>


             @foreach($videos as $video)

                    <div class="col-xl-3 col-lg-6 col-md-4 col-sm-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">{{$video->name}}</h5>

                        </div>

                        <div class="card-footer">
                            <a  href="{{route('viewVideo', [$video->id, $video->slug])}}" class="btn btn-primary btn-sm btn-block"><i class="fa fa-tv"></i> Watch Video</a>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
        @endif

        @if($posts )
            <div class="row">
                <h3 class="card-title mb-5">Article {{$page_title}}</h3>

            @foreach($posts as $post)

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
                                <p>{!! html_entity_decode(Str::limit($post->content, 200)) !!}</p>

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
            </div>
        @endif
    @if($posts->isEmpty() && $videos->isEmpty())
                <div class="alert alert-danger solid alert-dismissible fade show">
                    <svg viewBox="0 0 24 24" width="24 " height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                    <strong>Sorry!</strong> No Result Found.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                    </button>
                </div>
    @endif


@endsection
