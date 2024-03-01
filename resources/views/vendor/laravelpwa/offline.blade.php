@include('includes.main.head')

<body class="h-100">
<div class="authincation h-100">
    <div class="container h-100">
        <div class="row justify-content-center h-100 align-items-center">
            <div class="col-md-5">
                <div class="form-input-content text-center error-page">
                    <h1 class="error-text font-weight-bold">Offline</h1>
                    <h4><i class="fas fa-exclamation-triangle text-warning"></i> Unable to connect</h4>
                    <p>Please check your Internet Connection to proceed</p>
                    <div>
                        <a class="btn btn-primary" href="{{route('home')}}">Back to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
@include('includes.main.scripts')
