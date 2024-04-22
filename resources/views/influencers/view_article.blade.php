@extends('layouts.plain')

@section('content')
    <div class="row">
        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-6">
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

        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
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
                    <form method="post" action="{{route('addArticleComment')}}">
                        @csrf

                        <input type="hidden" name="id" value="{{$resource->id}}">
                        <input type="hidden" name="slug" value="{{$resource->slug}}">
                        <div class="form-group">
                            <label class="mb-1"><strong>Full Name<span class="text-danger">*</span></strong></label>
                            <input type="text" class="form-control" name="name"  required >

                        </div>
                        <div class="form-group">
                            <label class="mb-1"><strong>Email Address</strong></label>
                            <input type="email" class="form-control" name="email">

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
    @endsection

@section('script')
    <script>
        const ps5 = new PerfectScrollbar('#commentList', {
            useBothWheelAxes: true,
            suppressScrollX: true
        });
    </script>
    @endsection
