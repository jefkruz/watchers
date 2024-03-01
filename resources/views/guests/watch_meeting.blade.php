@extends('layouts.guest')



@section('content')

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body border-top">
                    <div class="row">
                        <div class="col-md-12">
                            <video id="video" class="video-js"></video>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header  border-0 pb-0">
                    <h4 class="card-title">Live Chat</h4>



                </div>
                <div class="card-body">
                    <div id="DZ_W_Todo1" class="widget-media dz-scroll height370 ps ps--active-y">
                        <div class="main-chat-body flex-2" id="ChatBody">
                            <div class="content-inner" id="chatInner">


                            </div>
                        </div>
{{--                        <ul class="timeline">--}}
{{--                            <li>--}}
{{--                                <div class="timeline-panel">--}}
{{--                                    <div class="media me-2">--}}
{{--                                        <img alt="image" width="50" src="images/avatar/1.jpg">--}}
{{--                                    </div>--}}
{{--                                    <div class="media-body">--}}
{{--                                        <h5 class="mb-1">Dr sultads Send you Photo</h5>--}}
{{--                                        <small class="d-block">29 July 2020 - 02:26 PM</small>--}}
{{--                                    </div>--}}
{{--                                   --}}
{{--                                </div>--}}
{{--                            </li>--}}

{{--                        </ul>--}}
                        <div class="ps__rail-x" style="left: 0px; bottom: -85px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 85px; height: 370px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 70px; height: 300px;"></div></div></div>
                </div>
                <div class="card-footer d-sm-flex justify-content-between align-items-center">

                    <input id="chatInput" class="form-control" placeholder="Type your message here..." type="text">
                    <button  id="chatBtn" class="btn btn-primary" type="button">Send</button>

                    <nav class="nav">
                    </nav>
                </div>
            </div>

        </div>

    </div>
@endsection
@section('script')
    <script src="https://vjs.zencdn.net/8.3.0/video.min.js"></script>
    <script>
        const ps5 = new PerfectScrollbar('#ChatBody', {
            useBothWheelAxes: true,
            suppressScrollX: true,
        });

        const player = videojs('video', {
            controls: true,
            fluid: true,
            liveui: true
        });

        const vidSource = '{{$meeting->stream_link}}';

        const source = {
            src: vidSource,
            type: 'application/x-MpegURL'
        };

        player.src(source);

        const chatInput = $('#chatInput');
        const chatBtn = $('#chatBtn');
        const chatInner = $('#chatInner');

        $.ajax({
            method: "post",
            url: "{{route('markGuestAttendance')}}",
            data: {meeting: '{{$meeting->id}}', _token: '{{csrf_token()}}'},
            success: function(){}
        });

        setInterval(function(){
            fetchChats();
        }, 20000);

        fetchChats();

        chatBtn.on('click', function(e){
            e.preventDefault();
            const msg = chatInput.val().trim();
            chatInput.val('');
            if(msg.length){
                sendChat(msg);
            }
        });

        chatInput.on('keyup', function(e){
            if(e.which === 13){
                const msg = chatInput.val().trim();
                chatInput.val('');
                if(msg.length){
                    sendChat(msg);
                }
            }
        });


        function fetchChats(){
            const meeting = '{{$meeting->id}}';
            $.ajax({
                method: "get",
                url: "{{route('fetchChats')}}",
                data: {meeting: meeting},
                success: function(data){
                    const html = renderMessage(data.data);
                    chatInner.html(html);
                }
            });
        }

        function sendChat(message){
            const meeting = '{{$meeting->id}}';
            $.ajax({
                method: "post",
                url: "{{route('addChat')}}",
                data: {meeting: meeting, message: message, _token: '{{csrf_token()}}'},
                success: function(data){
                    const html = renderMessage([data.data]);
                    chatInner.append(html);
                }
            });
        }

        function renderMessage(data){
            const userID = '{{session('guest')->id}}';
            let html = '';
            for(let i = 0; i < data.length; i++){
                const id = data[i].user_id;
                const cl = (Number(userID) === Number(id)) ? 'flex-row-reverse chat-right' : 'chat-left';
                html += '<div class="media ' + cl + '">';

                html += '<div class="main-img-user online">';
                html += '<img src="' + data[i].picture + '">';
                html += '</div>';

                html += '<div class="media-body">';

                html += '<div class="main-msg-wrapper">';
                html += '<small class="text-bold">' + data[i].name + '</small><br>';
                html += data[i].message;
                html += '</div>';
                html += '<div><span>' + data[i].timeAdded + '</span></div>';
                html += '</div>';

                html += '</div>';
            }

            return html;
        }
    </script>
@endsection

@section('styles')
    <link href="https://vjs.zencdn.net/8.3.0/video-js.css" rel="stylesheet" />
@endsection

