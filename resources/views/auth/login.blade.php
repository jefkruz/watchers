<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="influencers, watchers, The Watchers, influencers network" />
    <meta name="author" content="Loveworld Inc" />
    <meta name="robots" content="index, follow" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="The Watchers Influencers Network " />
    <meta property="og:title" content="The Watchers: Influencers Network" />
    <meta property="og:description" content="The Watchers: Influencers Network" />
    <meta name="format-detection" content="telephone=no">

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
                                    <a href="{{route('home')}}"><img src="{{asset('images/favicon.png')}}"  width="300px" alt=""></a>
                                </div>
                                <h4 class="text-center mb-4">Sign in your account</h4>
                                @include('includes.main.alerts')
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label class="mb-1"><strong>Email</strong></label>
                                        <input type="email"  name="email" value="{{ old('email') }}"class="form-control @error('email') is-invalid @enderror" >
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                               <strong>{{ $message }}</strong>
                                             </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="mb-1"><strong>Password</strong></label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <div class="form-row d-flex justify-content-between mt-4 mb-2">
                                        <div class="form-group">
                                            <div class="form-check custom-checkbox ms-1">
                                                <input type="checkbox" class="form-check-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="basic_checkbox_1">Remember my preference</label>
                                            </div>
                                        </div>
                                        <div class="form-group">

                                            <a  href="{{ route('password.reset') }}">Forgot Password?</a>

                                        </div>

                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary btn-block">Sign Me In</button>
                                    </div>
                                </form>
                                <div class="new-account mt-3">
                                    <p>Don't have an account? <a class="new-color" href="{{route('register')}}">Sign up</a></p>
                                </div>
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
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-MDGXJTZL0L"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-MDGXJTZL0L');
</script>
</body>

</html>
