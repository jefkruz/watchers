<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="influencers, your Loveworld, influencers network" />
    <meta name="author" content="Loveworld Inc" />
    <meta name="robots" content="index, follow" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Your Loveworld Specials: Influencers Network " />
    <meta property="og:title" content="Your Loveworld Specials: Influencers Network" />
    <meta property="og:description" content="Your Loveworld Specials: Influencers Network" />
    <meta name="format-detection" content="telephone=no">
    <link rel="manifest" href="/manifest.json">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{$page_title ?? ' '}}</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('images/logo.png')}}">

@yield('styles')
@yield('datastyles')
<!-- Custom Stylesheet -->
    <link href="{{asset('main/vendor/bootstrap-select/dist/css/bootstrap-select.min.css')}}" rel="stylesheet">
    <link href="{{asset('main/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('main/vendor/owl-carousel/owl.carousel.css')}}" rel="stylesheet">


</head>
<body class="h-100">
<div class="authincation h-100">
    <div class="container h-100">
        <div class="row justify-content-center h-100 align-items-center">
            <div class="col-md-6">
                <div class="authincation-content">
                    <div class="row no-gutters">
                        <div class="col-xl-12">
                            <div class="auth-form">
                                <div class="text-center mb-3">
                                    <a href="{{route('home')}}"><img src="{{asset('images/favicon.png')}}" width="300px" alt=""></a>
                                </div>
                                <h4 class="text-center mb-4">Reset Password </h4>
                                @include('includes.main.alerts')
                                <form method="POST" action="{{ route('resetPassword', [$user->username, $user->password_token]) }}">
                                    @csrf

                                    <div class="form-group">
                                        <label><strong>Password</strong></label>
                                        <input id="password" type="password" class="form-control " name="password" required autocomplete="new-password">

                                    </div>
                                    <div class="form-group">
                                        <label><strong>Confirm Password</strong></label>
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">

                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary btn-block">{{ __('Reset Password ') }}</button>
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

<!-- Required vendors -->
<script src="{{asset('main/vendor/global/global.min.js')}}"></script>
<script src="{{asset('main/vendor/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>
<script src="{{asset('main/js/custom.min.js')}}"></script>
<script src="{{asset('main/js/deznav-init.js')}}"></script>

</body>

</html>
