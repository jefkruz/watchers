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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('images/favicon.png')}}">

@yield('styles')
@yield('datastyles')
<!-- Custom Stylesheet -->
    <link href="{{asset('main/vendor/bootstrap-select/dist/css/bootstrap-select.min.css')}}" rel="stylesheet">
    <link href="{{asset('main/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('main/vendor/owl-carousel/owl.carousel.css')}}" rel="stylesheet">
    @laravelPWA

</head>
<body>
<!--*******************
      Preloader start
  ********************-->
<div id="preloader">
    <div class="sk-three-bounce">
        <div class="sk-child sk-bounce1"></div>
        <div class="sk-child sk-bounce2"></div>
        <div class="sk-child sk-bounce3"></div>
    </div>
</div>
<!--*******************
    Preloader end
********************-->

<!--**********************************
       Main wrapper start
   ***********************************-->
<div id="main-wrapper">

    <!--**********************************
        Nav header start
    ***********************************-->
    <div class="nav-header">
        <a href="{{route('home')}}" class="brand-logo">
            <img class="logo-abbr" src="{{asset('images/favicon.png')}}" alt="">
            <img class="logo-compact" src="{{asset('images/logo.png')}}" alt="">
            <img class="brand-title" src="{{asset('images/name.png')}}" alt="">
        </a>

        <div class="nav-control">
            <div class="hamburger">
                <span class="line"></span><span class="line"></span><span class="line"></span>
            </div>
        </div>
    </div>
    <!--**********************************
        Nav header end
    ***********************************-->

@include('includes.main.guest_navbar')
@include('includes.main.guest_sidebar')

</body>
<!--**********************************
        Content body start
    ***********************************-->
<div class="content-body">
    <div class="container-fluid">
{{--        <div class="page-titles">--}}
{{--            <ol class="breadcrumb">--}}
{{--                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>--}}
{{--                <li class="breadcrumb-item active"><a href="javascript:void(0)">{{$page_title?? ''}}</a></li>--}}
{{--            </ol>--}}
{{--        </div>--}}

    @yield('content')

    <!--**********************************
            Footer start
 ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Copyright ©  <a href="#" target="_blank">Loveworld Incorporated</a> <script>document.write(new Date().getFullYear());</script></p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->

        @include('includes.main.scripts')
        @yield('script')
        </body>
        </html>

