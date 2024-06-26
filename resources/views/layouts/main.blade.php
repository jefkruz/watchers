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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('images/logo.png')}}">

@yield('styles')
@yield('datastyles')
<!-- Custom Stylesheet -->
    <link href="{{asset('main/vendor/bootstrap-select/dist/css/bootstrap-select.min.css')}}" rel="stylesheet">
    <link href="{{asset('main/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('main/vendor/owl-carousel/owl.carousel.css')}}" rel="stylesheet">


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
            <img class="logo-abbr" src="{{asset('images/logo.png')}}" alt="">
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

@include('includes.main.navbar')
@include('includes.main.sidebar')

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
                <p>Copyright ©  <a href="#" target="_blank">Watchers Network</a> <script>document.write(new Date().getFullYear());</script></p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->


    <script src="https://www.gstatic.com/firebasejs/7.14.6/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.14.6/firebase-messaging.js"></script>
    <script>
        const firebaseConfig = {
            apiKey: "AIzaSyCfI0RjtLBUiBH5_5z_uYBzIIOmnNDsW28",
            authDomain: "ylwsin.firebaseapp.com",
            projectId: "ylwsin",
            storageBucket: "ylwsin.appspot.com",
            messagingSenderId: "910184955626",
            appId: "1:910184955626:web:a10a3fde7ff25ff98ca193",
            measurementId: "G-WB5DJKF9JY"
        };
        firebase.initializeApp(firebaseConfig);
        const messaging=firebase.messaging();


        function IntitalizeFireBaseMessaging() {
            messaging
                .requestPermission()
                .then(function () {
                    console.log("Notification Permission");
                    return messaging.getToken();
                })
                .then(function (token) {
                    savetoken(token);

                })
                .catch(function (reason) {
                    console.log(reason);
                });
        }

        messaging.onMessage(function (payload) {
            console.log(payload);
            const notificationOption={
                body:payload.notification.body,
                icon:payload.notification.icon
            };

            if(Notification.permission==="granted"){
                console.log('Showing notification');
                var notification = new Notification(payload.notification.title,notificationOption);

                notification.onclick=function (ev) {
                    ev.preventDefault();
                    window.open(payload.notification.click_action,'_blank');
                    notification.close();
                }
            }

        });
        messaging.onTokenRefresh(function () {
            messaging.getToken()
                .then(function (newtoken) {
                    savetoken(newtoken);
                })
                .catch(function (reason) {
                    console.log(reason);
                })
        })
        IntitalizeFireBaseMessaging();

        function savetoken(token){


            const joseph = (!!localStorage.getItem('token')) ? localStorage.getItem('token') : null;
            localStorage.setItem('token',token);
            // Send the AJAX request with the token data using Laravel syntax

            $.ajax({
                url: '{{route('saveToken')}}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    newtoken: token,
                    oldtoken: joseph,
                },
                dataType: 'json',
                success: function(response) {
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log('Error gotten');
                    console.log(textStatus + ': ' + errorThrown);
                }
            });
        }

        // Get the Firebase registration token
        messaging.getToken().then(function(token) {

            savetoken(token);

        }).catch(function(error) {
            console.log('Error getting Firebase registration token: ', error);
        });
    </script>

    @include('includes.main.scripts')
        @yield('script')
        </body>
        </html>

