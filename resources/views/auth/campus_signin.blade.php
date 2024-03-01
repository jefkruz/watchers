<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="The Watchers influencers network" />
    <meta name="author" content="The Watchers influencers network" />
    <meta name="robots" content="index, follow" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="The Watchers influencers network " />
    <meta property="og:title" content="The Watchers influencers network" />
    <meta property="og:description" content="The Watchers influencers network" />
    <meta name="format-detection" content="telephone=no">
    <link rel="manifest" href="/manifest.json">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{$page_title ?? ' '}}</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('images/favicon.png')}}">

@yield('styles')
@yield('datastyles')
<!-- Custom Stylesheet -->
    <link href="{{asset('main/vendor/bootstrap-select/dist/css/bootstrap-select.min.css')}}" rel="stylesheet">
    <link href="{{asset('main/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('main/vendor/owl-carousel/owl.carousel.css')}}" rel="stylesheet">
    @laravelPWA

</head>

<body class="h-100">
<div class="authincation h-100">
    <div class="container h-100">
        <div class="row justify-content-center h-100 align-items-center">
            <div class="col-md-8">

                <div class="authincation-content">
                    <div class="row no-gutters">
                        <div class="col-xl-12">
                            <div class="auth-form">
                                <div class="text-center mb-3">
                                    <a href="{{route('home')}}"><img src="{{asset('images/logo.png')}}" width="300px" alt=""></a>
                                </div>
                                <h4 class="text-center mb-4">Sign up your account</h4>
                                @include('includes.main.alerts')

                                    <h4 class="text-center mb-4">You are Registering Under  <b>{{ucwords($campusName)}}</b></h4>

                                <form method="POST" action="{{ route('signIn') }}">
                                    @csrf

                                    <input type="hidden" name="referral_id" value="1" required>
                                    <input type="hidden" name="zone" value="{{$campus}}" required>
                                    <div class="form-group">
                                        <label class="mb-1"><strong>Full Name<span class="text-danger">*</span></strong></label>
                                        <input type="text" class="form-control" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    </div>
                                    <div class="form-group">
                                        <label class="mb-1"><strong>Email<span class="text-danger">*</span></strong></label>
                                        <input type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email">
                                    </div>
{{--                                    <div class="form-group">--}}
{{--                                        <label class="mb-1"><strong>Phone Number<span class="text-danger">*</span></strong></label>--}}
{{--                                        <input type="text" class="form-control" inputmode="tel" name="phone" value="{{ old('phone') }}" required autocomplete="phone">--}}
{{--                                    </div>--}}
                                    <div class="form-group">
                                        <label class="mb-1"><strong>Country<span class="text-danger">*</span></strong></label>
                                        <select class="form-select   form-control wide  mb-3"  name="country" required>
                                            @foreach($countries as $country)
                                                <option value="{{$country->name}}" @if (old('country') == $country->name) selected="selected" @endif>{{$country->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="text-center mt-4">
                                        <button type="submit" class="btn btn-primary btn-block">SIGN IN</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('includes.main.scripts')
