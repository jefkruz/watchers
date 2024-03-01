@extends('layouts.guest')


@section('content')


    <div class="row">
        <div class="col-xl-8">
            <div class="card">
                <div class="card-body">
                    <div class="post-details">
                        <h3 class="mb-2 text-black">Share A Testimony</h3>

                        @include('includes.main.alerts')
                        <div class="comment-respond" id="respond">
                            {{--                            <h4 class="comment-reply-title text-primary mb-3" id="reply-title">Leave a Reply </h4>--}}
                            <form class="comment-form" action="" method="post">
                                @csrf
                                <input type="hidden" name="user_id" value="{{session('guest')->id}}">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="author" class="text-black font-w600">Name <span class="required">*</span></label>
                                            <input type="text" readonly class="form-control" value="{{session('guest')->name}}" name="name" >
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="email" class="text-black font-w600">Email <span class="required">*</span></label>
                                            <input type="text" readonly class="form-control" value="{{session('guest')->email}}" placeholder="Email" name="email" >
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="email" class="text-black font-w600">Subject <span class="required">*</span></label>
                                            <input type="text" class="form-control" value="{{old('subject')}}" placeholder="Topic of your testimony" name="subject" >
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="comment" class="text-black font-w600">Testimony</label>
                                            <textarea rows="8" class="form-control" name="testimony" placeholder="Your testimony" id="comment"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <button type="submit"  class="submit btn btn-primary" >Post Testimony</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="profile-news">
                                <h5 class="text-primary d-inline">Our Testimonials</h5>
{{--                                <div class="media pt-3 pb-3">--}}
{{--                                    <img src="{{asset('images/user.jpg')}}" alt="image" class="me-3 rounded" width="75">--}}
{{--                                    <div class="media-body">--}}
{{--                                        <h5 class="m-b-5"><a href="#" class="text-black">Collection of textile samples</a></h5>--}}
{{--                                        <p class="mb-0">I shared this on my fb wall a few months back, and I thought.</p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="media pt-3 pb-3">--}}
{{--                                    <img src="{{asset('images/user.jpg')}}" alt="image" class="me-3 rounded" width="75">--}}
{{--                                    <div class="media-body">--}}
{{--                                        <h5 class="m-b-5"><a href="#" class="text-black">Collection of textile samples</a></h5>--}}
{{--                                        <p class="mb-0">I shared this on my fb wall a few months back, and I thought.</p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="media pt-3 pb-3">--}}
{{--                                    <img src="{{asset('images/user.jpg')}}" alt="image" class="me-3 rounded" width="75">--}}
{{--                                    <div class="media-body">--}}
{{--                                        <h5 class="m-b-5"><a href="#" class="text-black">Collection of textile samples</a></h5>--}}
{{--                                        <p class="mb-0">I shared this on my fb wall a few months back, and I thought.</p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
