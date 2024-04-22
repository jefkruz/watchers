@extends('layouts.plain')


@section('content')
    <div class="row">
        @foreach($resources as $post)
            <div class="col-xl-4 col-lg-6 col-md-4 col-sm-6">
                <a href="{{route('viewArticle', [$post->id, $post->slug])}}">
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

@endsection
