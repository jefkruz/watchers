@extends('layouts.main')



@section('content')
    @if ($videos->count() < 1)
        <div class="alert alert-danger solid alert-dismissible fade show">
            <svg viewBox="0 0 24 24" width="24 " height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
            <strong>Sorry!</strong> No Result Found.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
            </button>
        </div>
    @else
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
@endsection
