@include('includes.main.head')

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
                                <h4 class="text-center mb-4">Prayer of Salvation</h4>
                                <p>O Lord God, I believe with all my heart in Jesus Christ,
                                    Son of the living God. I believe He died for me and God raised Him from the dead.
                                    I believe He's alive today. I confess with my mouth that Jesus Christ is the Lord of my life from this day.
                                    Through Him and in His Name, I have eternal life; I'm born again.
                                    Thank you Lord, for saving my soul! I'm now a child of God. Hallelujah!</p>
                                @include('includes.main.alerts')
                                <form method="POST" action="">
                                    @csrf

                                    <div class="form-group">
                                        <label class="mb-1"><strong>Full Name<span class="text-danger">*</span></strong></label>
                                        <input type="text" class="form-control" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    </div>
                                    <div class="form-group">
                                        <label class="mb-1"><strong>Email<span class="text-danger">*</span></strong></label>
                                        <input type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email">
                                    </div>
                                    <div class="form-group">
                                        <label class="mb-1"><strong>Phone Number<span class="text-danger">*</span></strong></label>
                                        <input type="text" class="form-control" inputmode="tel" name="phone" value="{{ old('phone') }}" required autocomplete="phone">
                                    </div>


                                    <div class="text-center mt-4">
                                        <button type="submit" class="btn btn-success btn-block">Get Born Again</button>
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
