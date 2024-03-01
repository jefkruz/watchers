@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                @if($resource->image)
                <img src="{{url($resource->image)}}" class="card-img-top" alt="img">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{$resource->title}}</h5>
                    <h6 class="card-subtitle mb-2 text-muted"><i class="fa fa-calendar-o"></i> {{$resource->created_at->diffForHumans()}}</h6>
                    {!! $resource->content !!}
                </div>

            </div>
        </div>

        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Comments</div>
                </div>
                <div class="card-body" id="commentList">
                    <div id="DZ_W_Todo3" class="widget-media dz-scroll height370 ps ps--active-y">
                        <ul class="timeline">
                    @foreach($resource->comments() as $comment)
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
    @endsection

@section('script')
    <script>
        const ps5 = new PerfectScrollbar('#commentList', {
            useBothWheelAxes: true,
            suppressScrollX: true
        });
    </script>
    @endsection
