@extends('layouts.main')
@section('content')

    <div class="row">

        <div class="col-xl-4 col-xxl-8 col-lg-8">
            <div class="card">
                <div class="card-header  border-0 pb-0">
                    <h4 class="card-title">Notifications</h4>
                </div>
                <div class="card-body">
                    <div id="DZ_W_Todo1" class="widget-media dz-scroll height370">
                        <ul class="timeline">
                            @foreach($notifications as $notification)
                                @php
                                    $icons = [
                                    'post' => 'fa-scroll',
                                    'programme' => 'fa-tv',
                                    'announcement' => 'fa-bullhorn',
                                    'course' => 'fa-book-open'

                                    ];
                                @endphp
                            <li>
                                <a href="{{route('viewNotification', $notification->id)}}">
                                <div class="timeline-panel">
                                    <div class="media me-2">
                                        <i class="fa {{$icons[$notification->notification_type]}}"></i>
                                    </div>
                                    <div class="media-body">
                                        <h5 class="mb-1">{{ucfirst($notification->title)}}</h5>

                                        <span>{{ucfirst($notification->body)}}</span>
                                        <small class="d-block">{{$notification->created_at->diffForHumans()}}</small>
                                    </div>

                                </div>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection
