@extends('layouts.main')



@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body border-top">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <video id="video" class="video-js"></video>
                                </div>
                                <div class="col-md-12 text-center">
                                    <h4 class="text-bold" id="titleDisplay"></h4>
                                    <span><i class="fa fa-eye"></i> {{$views}} view(s)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Video Comments</div>
                        </div>

                        <div class="card-body" id="commentList">
                            <div id="DZ_W_Todo3" class="widget-media dz-scroll height370 ps ps--active-y">
                                <ul class="timeline">
                                    @foreach($comments as $comment)
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
                            <div class="form-group">
                                <label for="">Commenting as {{session('user')->name}}...</label>
                                <input type="text" id="commentField" class="form-control" placeholder="Enter comment and press enter">
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-4">
            <div class="card">
                @foreach($course->chapters() as $chapter)
                    <div class="card-header  br-te-3 br-ts-3" style="background-color:#b28c41">
                        <h3 class="card-title text-white">{{$chapter->name}}</h3>
                        <div class="card-options ">
                            {{--                            Hello--}}
                        </div>
                    </div>
                    <div class="card-body">
                        @foreach($chapter->materials() as $mat)
                            <div class="media mb-5 mt-0 ">
                                <div class="d-flex me-3">
                                    {{--                            <i class="fa fa-tv fa-2x"></i>--}}
                                </div>
                                <div class="media-body">
                                    <a href="javascript:void(0)" class="text-dark">{{$mat->title}}</a>
                                    <div class="text-muted small">{{$chapter->name}}</div>
                                </div>
                                <input type="hidden" id="course-title-{{$mat->id}}" value="{{$mat->title}}">
                                <button type="button" data-id="{{$mat->id}}" data-name-id="course-title-{{$mat->id}}" data-url="{{$mat->link}}" class="btn btn-primary btn-sm d-block playBtn"><i class="fa fa-play-circle"></i></button>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>

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

        const ps5 = new PerfectScrollbar('#commentList', {
            useBothWheelAxes: true,
            suppressScrollX: true
        });

        const commentList = $('#commentList');
        const commentField = $('#commentField');
        let videoID = '{{($first_video) ? $first_video->id : ''}}';

        const firstTitle = '{{($first_video) ? $first_video->title : ''}}';
        const firstUrl = '{{($first_video) ? $first_video->link : ''}}';
        if(firstTitle.length && firstUrl.length){
            setTimeout(function(){
                loadVideo(firstTitle, firstUrl);
            }, 1000);
        }

        function loadVideo(title, url, shouldPlay = false){
            titleDisplay.html(title);
            const spl = url.split('.');
            const ext = spl[spl.length - 1];

            const vidType = (ext === 'm3u8') ? 'application/x-MpegURL' : 'video/mp4';

            const source = {
                src: url,
                type: vidType
            };

            player.src(source);
            if(shouldPlay === true){
                player.play();
            }
        }

        const playBtn = $('.playBtn');
        const titleDisplay = $('#titleDisplay');

        playBtn.on('click', function(){
            const url = $(this).data('url');
            const nameID = $(this).data('name-id');
            videoID = $(this).data('id');

            const title = $('#' + nameID).val();

            loadVideo(title, url, true);
            commentList.empty();
            $.ajax({
                method: 'get',
                data: {video: videoID},
                url: '{{route('getVideoComments')}}',
                success: function(data){
                    const resp = data.data;
                    let html = '';
                    for(let i = 0; i < resp.length; i++){
                        html += renderComment(resp[i]);
                    }
                    commentList.html(html);
                }
            });

        });


        commentField.on('keyup', function(e){
            if(e.which === 13){
                const comment = commentField.val().trim();
                if(comment.length){
                    commentField.val('');
                    $.ajax({
                        url: '{{route('addVideoComment')}}',
                        data: {
                            _token: '{{csrf_token()}}',
                            comment: comment,
                            course: '{{$course->id}}',
                            video: videoID
                        },
                        method: 'post',
                        success: function(data){
                            const html = renderComment(data.data);
                            commentList.append(html);
                        },
                        error: function(err){
                            console.log(err);
                        }
                    });
                }
            }
        });

        function renderComment(data){

            let html = '<div id="DZ_W_Todo3" class="widget-media">';
            html += '<ul class="timeline">';
            html += '<li>';
            html += '<div class="timeline-panel">';
            html += '<div class="media me-2">';
            html += ' <img alt="image" width="50" src="'+ data.picture + '">';
            html += '</div>';
            html += '<div class="media-body">';
            html += '<h5 class="mb-1">' + data.name + '<small class="text-muted"></small></h5>';
            html += '<p class="mb-1">' + data.comment + '</p>';
            html += '</div>';
            html += '</div>';
            html += '</li>';
            html += '</ul>';
            html += '</div>';
            return html;
        }
    </script>
@endsection

