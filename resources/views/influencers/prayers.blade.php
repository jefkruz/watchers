@extends('layouts.main')


@section('content')


    <div class="row">
        <div class="col-xl-8">
            <div class="card">
                <div class="card-body">
                    <div class="post-details">
                        <h3 class="mb-2 text-black">Prayer Requests</h3>

                        @include('includes.main.alerts')
                        <div class="comment-respond" id="respond">
                            {{--                            <h4 class="comment-reply-title text-primary mb-3" id="reply-title">Leave a Reply </h4>--}}
                            <form class="comment-form" action="" method="post">
                                @csrf
                                <input type="hidden" name="user_id" value="{{session('user')->id}}">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="author" class="text-black font-w600">Name <span class="required">*</span></label>
                                            <input type="text" readonly class="form-control" value="{{session('user')->name}}" name="name" >
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="email" class="text-black font-w600">Email <span class="required">*</span></label>
                                            <input type="text" readonly class="form-control" value="{{session('user')->email}}" placeholder="Email" name="email" >
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="email" class="text-black font-w600">Prayer Point <span class="required">*</span></label>
                                            <input type="text" class="form-control" value="{{old('subject')}}" placeholder="Topic of your prayer request" name="subject" >
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="comment" class="text-black font-w600">Prayer</label>
                                            <textarea rows="8" class="form-control"  name="prayer" placeholder="Your Prayer Request" ></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <button type="submit"  class="submit btn btn-primary" >Submit</button>
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

        </div>

    </div>
@endsection
