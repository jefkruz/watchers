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
            <div class="col-md-8">

                <div class="authincation-content">
                    <div class="row no-gutters">
                        <div class="col-xl-12">
                            <div class="auth-form">
                                <div class="text-center mb-3">
                                    <a href="{{route('home')}}"><img src="{{asset('images/favicon.png')}}" width="300px" alt=""></a>
                                </div>
                                <h4 class="text-center mb-4">Sign up your account</h4>
                                @include('includes.main.alerts')
                                @if($refer->username != 'admin')
                                    <h4 class="text-center mb-4">You are being referred by <b>{{ucwords($refer->name)}}</b></h4>
                                @endif
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <input type="hidden" name="role_id" value="1">
                                    <input type="hidden" name="referral_id" value="{{$refer->id}}" required>
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
                                    <div class="row">

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="mb-1"><strong>Username<span class="text-danger">*</span></strong></label>
                                                <input type="text" class="form-control" name="username" value="{{ old('username') }}" required autocomplete="username">
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <label class="mb-1"><strong>Gender<span class="text-danger">*</span></strong></label>
                                            <div class="mb-3 mb-0">
                                                <select class="form-select   form-control wide"  name="gender">
                                                    <option value="male" @if (old('gender') == 'male') selected="selected" @endif>Male</option>
                                                    <option value='female' @if (old('gender') == 'female') selected="selected" @endif>Female</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="mb-1"><strong>City<span class="text-danger">*</span></strong></label>
                                                <input type="text" class="form-control" name="city" value="{{ old('city') }}" required autocomplete="city">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">

                                                <label class="mb-1"><strong>Country<span class="text-danger">*</span></strong></label>
                                                <select class="form-select   form-control wide  mb-3"  name="country" required>
                                                    @foreach($countries as $country)
                                                        <option value="{{$country->name}}" @if (old('country') == $country->name) selected="selected" @endif>{{$country->name}}</option>
                                                    @endforeach
                                                </select>

                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="mb-1"><strong>Day of Birth<span class="text-danger">*</span></strong></label>
                                                <select class="form-select   form-control wide"  name="birth_date">
                                                    @for ($day = 1; $day <= 31; $day++)
                                                        <option value="{{ $day }}">{{ $day }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="mb-1"><strong>Month of Birth<span class="text-danger">*</span></strong></label>
                                            <select class="form-select   form-control wide"  name="birth_month">
                                                @for ($i = 1; $i <= 12; $i++)
                                                    <option value="{{ $i }}" @if (old('month') == $i) selected="selected" @endif>{{ date('F', mktime(0, 0, 0, $i, 1)) }}</option>
                                                @endfor

                                            </select>
                                        </div>



                                        <div class="col-sm-12">
                                            <label class="mb-1"><strong>Are You a Christ Embassy Member<span class="text-danger">*</span></strong></label>
                                            <div class="mb-3 mb-0">
                                                <select  id="church_member"  class="form-select form-control wide"  name="member">
                                                    <option value="no">No</option>
                                                    <option value="yes">Yes</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div  id="church_div" class="col-sm-6" style="display: none">
                                            <div class="form-group">
                                                <label class="mb-1"><strong>Church</strong></label>
                                                <input type="text" class="form-control" name="church" value="{{ old('church') }}" required autocomplete="church">
                                            </div>
                                        </div>
                                        <div  id="zone_div" class="col-sm-6" style="display: none">

                                            <label class="mb-1"><strong>Zone</strong></label>
                                            <select class="form-select   form-control wide  mb-3"  name="zone" required>
                                                <optgroup label="Church Zones">
                                                    @foreach($zones as $zone)
                                                        <option value="{{$zone->name}}" @if (old('zone') == $zone->name) selected="selected" @endif>{{$zone->name}}</option>
                                                    @endforeach
                                                </optgroup>
                                                <optgroup label="Campus Zones">
                                                    @foreach($campus as $camp)
                                                        <option value="{{$camp->name}}"@if (old('zone') == $camp->name) selected="selected" @endif>{{$camp->name}}</option>
                                                    @endforeach
                                                </optgroup>
                                            </select>

                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="mb-1"><strong>Password<span class="text-danger">*</span></strong></label>
                                                <input type="password" class="form-control" name="password" required autocomplete="new-password">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="mb-1"><strong>Confirm Password<span class="text-danger">*</span></strong></label>
                                                <input type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-center mt-4">
                                        <button type="submit" class="btn btn-primary btn-block">REGISTER</button>
                                    </div>
                                </form>
                                <div class="new-account mt-3">
                                    <p>Already have an account? <a class="new-color" href="{{route('login')}}">Sign in</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const churchMemberSelect = document.getElementById("church_member");
        const churchDiv = document.getElementById("church_div");
        const zoneDiv = document.getElementById("zone_div");

        churchMemberSelect.addEventListener("change", function () {
            if (this.value === "yes") {
                churchDiv.style.display = "block";
                zoneDiv.style.display = "block";
            } else {
                churchDiv.style.display = "none";
                zoneDiv.style.display = "none";
            }
        });
    });
</script>
@include('includes.main.scripts')
