{{--<script src="https://www.gstatic.com/firebasejs/7.14.6/firebase-app.js"></script>--}}
{{--<script src="https://www.gstatic.com/firebasejs/7.14.6/firebase-messaging.js"></script>--}}
{{--<script>--}}
{{--    const firebaseConfig = {--}}
{{--        apiKey: "AIzaSyCfI0RjtLBUiBH5_5z_uYBzIIOmnNDsW28",--}}
{{--        authDomain: "ylwsin.firebaseapp.com",--}}
{{--        projectId: "ylwsin",--}}
{{--        storageBucket: "ylwsin.appspot.com",--}}
{{--        messagingSenderId: "910184955626",--}}
{{--        appId: "1:910184955626:web:a10a3fde7ff25ff98ca193",--}}
{{--        measurementId: "G-WB5DJKF9JY"--}}
{{--    };--}}
{{--    firebase.initializeApp(firebaseConfig);--}}
{{--    const messaging=firebase.messaging();--}}

{{--    function IntitalizeFireBaseMessaging() {--}}
{{--        messaging--}}
{{--            .requestPermission()--}}
{{--            .then(function () {--}}
{{--                console.log("Notification Permission");--}}
{{--                return messaging.getToken();--}}
{{--            })--}}
{{--            .then(function (token) {--}}
{{--                console.log("Token : "+token);--}}

{{--            })--}}
{{--            .catch(function (reason) {--}}
{{--                console.log(reason);--}}
{{--            });--}}
{{--    }--}}

{{--    messaging.onMessage(function (payload) {--}}
{{--        console.log(payload);--}}
{{--        const notificationOption={--}}
{{--            body:payload.notification.body,--}}
{{--            icon:payload.notification.icon--}}
{{--        };--}}

{{--        if(Notification.permission==="granted"){--}}
{{--            var notification=new Notification(payload.notification.title,notificationOption);--}}

{{--            notification.onclick=function (ev) {--}}
{{--                ev.preventDefault();--}}
{{--                window.open(payload.notification.click_action,'_blank');--}}
{{--                notification.close();--}}
{{--            }--}}
{{--        }--}}

{{--    });--}}
{{--    messaging.onTokenRefresh(function () {--}}
{{--        messaging.getToken()--}}
{{--            .then(function (newtoken) {--}}
{{--              savetoken(newtoken);--}}
{{--            })--}}
{{--            .catch(function (reason) {--}}
{{--                console.log(reason);--}}
{{--            })--}}
{{--    })--}}
{{--    IntitalizeFireBaseMessaging();--}}

{{--    function savetoken(token){--}}

{{--        const joseph = (!!localStorage.getItem('token')) ? localStorage.getItem('token') : null;--}}
{{--        localStorage.setItem('token',token);--}}
{{--        // Send the AJAX request with the token data using Laravel syntax--}}

{{--        $.ajax({--}}
{{--            url: '{{route('saveToken')}}',--}}
{{--            type: 'POST',--}}
{{--            data: {--}}
{{--                _token: '{{ csrf_token() }}',--}}
{{--                newtoken: token,--}}
{{--                oldtoken: joseph,--}}
{{--            },--}}
{{--            dataType: 'json',--}}
{{--            success: function(response) {--}}
{{--                console.log(response);--}}
{{--            },--}}
{{--            error: function(jqXHR, textStatus, errorThrown) {--}}
{{--                console.log(textStatus + ': ' + errorThrown);--}}
{{--            }--}}
{{--        });--}}
{{--    }--}}

{{--    // Get the Firebase registration token--}}
{{--    messaging.getToken().then(function(token) {--}}

{{--        savetoken(token);--}}

{{--    }).catch(function(error) {--}}
{{--        console.log('Error getting Firebase registration token: ', error);--}}
{{--    });--}}
{{--</script>--}}

<!-- Required vendors -->
<script src="{{asset('main/vendor/global/global.min.js')}}"></script>
<script src="{{asset('main/vendor/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>
<script src="{{asset('main/js/custom.min.js')}}"></script>
<script src="{{asset('main/js/deznav-init.js')}}"></script>
@yield('datascripts')

<!-- Init file -->
<script src="{{asset('main/js/plugins-init/widgets-script-init.js')}}"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.7/dist/sweetalert2.all.min.js"></script>


<!-- Toastr -->
<script src="{{asset('main/vendor/toastr/js/toastr.min.js')}}"></script>

<!-- All init script -->
<script src="{{asset('main/js/plugins-init/toastr-init.js')}}"></script>
<script src="{{asset('main/vendor/owl-carousel/owl.carousel.js')}}"></script>

<script>
    @if(Session::has('message'))
    var type = "{{ Session::get('alert-type', 'success') }}";
    switch(type){
        case 'info':
            toastr.info("{{ Session::get('message') }}");
            break;

        case 'warning':
            toastr.warning("{{ Session::get('message') }}");
            break;

        case 'success':
            toastr.success("{{ Session::get('message') }}");
            break;

        case 'error':
            toastr.error("{{ Session::get('message') }}");
            break;
    }
    @endif
</script>

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
