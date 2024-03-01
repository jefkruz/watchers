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

                                @include('includes.main.alerts')
                                <form method="POST" action="">
                                    @csrf
                                    <input type="hidden" name="role_id" value="2">
                                    <input type="hidden" name="referral_id" value="{{$username->id}}">
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
                                                <label class="mb-1"><strong>Date of Birth<span class="text-danger">*</span></strong></label>
                                                <select class="form-select   form-control wide"  name="dob">
                                                    @for ($day = 1; $day <= 31; $day++)
                                                        <option value="{{ $day }}">{{ $day }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="mb-1"><strong>Month of Birth<span class="text-danger">*</span></strong></label>
                                            <select class="form-select   form-control wide"  name="month">
                                                <option value="january" @if (old('month') == 'january') selected="selected" @endif>January</option>
                                                <option value='february' @if (old('month') == 'february') selected="selected" @endif>February</option>
                                                <option value='march'@if (old('month') == 'march') selected="selected" @endif>March</option>
                                                <option value='april'@if (old('month') == 'april') selected="selected" @endif>April</option>
                                                <option value='may'@if (old('month') == 'may') selected="selected" @endif>May</option>
                                                <option value='june'@if (old('month') == 'june') selected="selected" @endif>June</option>
                                                <option value='july'@if (old('month') == 'july') selected="selected" @endif>July</option>
                                                <option value='august'@if (old('month') == 'august') selected="selected" @endif>August</option>
                                                <option value='september'@if (old('month') == 'september') selected="selected" @endif>September</option>
                                                <option value='october'@if (old('month') == 'october') selected="selected" @endif>October</option>
                                                <option value='november'@if (old('month') == 'november') selected="selected" @endif>November</option>
                                                <option value='december'@if (old('month') == 'december') selected="selected" @endif>December</option>
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
                                        <hr>
                                        <h4 class="text-center mb-4"><strong>For Christ Embassy Members</strong></h4>


                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="mb-1"><strong>Church</strong></label>
                                                <input type="text" class="form-control" name="church" value="{{ old('church') }}" required autocomplete="church">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">

                                            <label class="mb-1"><strong>Zone</strong></label>
                                            <select class="form-select   form-control wide  mb-3"  name="zone" required>
                                                <optgroup label="Church Zones">--}}
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
@include('includes.main.scripts')
