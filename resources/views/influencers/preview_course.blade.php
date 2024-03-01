@extends('layouts.main')



@section('content')

    <div class="row">
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="fa fa-book-open  fa-3x" style="color:#b28c41"></i>
                            {{--                    <h6 class="mt-4 mb-2">Total Visit</h6>--}}
                            <h2 class="mb-2 number-font">{{$course->title}}</h2>
                            <p class="card-text">
                               <b> <small class="text-danger ">TRAINING TYPE:</small> {{strtoupper($course->course_type)}} COURSE</b><br>

                                @if($course->course_type == 'free')
                                   <br>
                                @else
                                    <small class="text-primary">USD Price:</small> $ {{number_format($course->course_fee_dollar, 2)}}<br>
                                    <small class="text-primary">Naira Price:</small> N {{number_format($course->course_fee_naira, 2)}}<br>
                                @endif

                            </p>

                            @if($course->course_type == 'free')
                                <button data-type="free" class="btn btn-primary purchaseBtn"><i class="fa fa-play"></i> START COURSE</button>
                            @else
                                <button data-currency="NGN" data-amount="{{$course->course_fee_naira}}" data-type="naira" class="btn btn-dark purchaseBtn"><i class="fa fa-shopping-cart"></i> NAIRA PURCHASE</button>
                                <button data-currency="USD" data-amount="{{$course->course_fee_dollar}}" data-type="dollar" class="btn btn-danger purchaseBtn"><i class="fa fa-shopping-cart"></i> USD PURCHASE</button>
                            @endif

                        </div>
                    </div>
                </div>

                @if($course->thumbnail)
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <img src="{{url($course->thumbnail)}}" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                @endif
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body text-center">
                            {!! $course->description !!}
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-8">
            <div class="row">
                @foreach($course->chapters() as $chapter)
                    <div class="col-md-12">
                        <div class="card m-b-20">
                            <div class="card-header">
                                <h3 class="card-title">{{$chapter->name}}</h3>
                                <div class="card-options">
                                    <a href="javascript:void(0)" class="card-options-collapse" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="visitor-list">

                                    @foreach($chapter->materials() as $mat)
                                        <div class="media m-0 mt-0 border-bottom">
                                            <div class="media-body">
                                                <a href="javascript:void(0)" class="text-default fw-semibold">{{$mat->title}}</a>
                                                {!! $mat->description !!}
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
@endsection
@section('script')
    <script>
        const purchaseBtn = $('.purchaseBtn');

        purchaseBtn.on('click', function(){
            const dType = $(this).data('type');
            if(dType === 'free'){
                $.ajax({
                    url: "{{route('purchaseFreeCourse')}}",
                    data: {_token: '{{csrf_token()}}', course: '{{$course->id}}'},
                    method: "post",
                    success: function(data){
                        if(data.status === true){
                            location.reload();
                        }
                    },
                    error: function(err){
                    }
                });
            } else {
                const currency = $(this).data('currency');
                const amount = $(this).data('amount');

                purchaseBtn.attr('disabled', true);

                $.ajax({
                    method: "post",
                    url: "{{route('initializeCoursePayment')}}",
                    data: {course: '{{$course->id}}', _token: '{{csrf_token()}}', currency: currency, amount: amount},
                    success: function(data){
                        purchaseBtn.attr('disabled', false);
                        location.href = data.data;
                    },
                    error: function(err){
                        purchaseBtn.attr('disabled', false);
                    }
                });

            }
        });
    </script>
@endsection

