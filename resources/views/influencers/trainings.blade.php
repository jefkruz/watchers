@extends('layouts.main')



@section('content')


    <div class="row">
        @foreach($trainings as $training)
        <div class="col-xl-4 col-lg-6 col-md-4 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="new-arrival-product">
                        <div class="new-arrivals-img-contnent">
                            <a href="{{route('viewtraining',$training->slug)}}">
                            <img class="img-fluid" src="{{asset('storage/'.$training->image)}}" alt="{{$training->title}}">
                            </a>
                        </div>
                        <div class="new-arrival-content text-center mt-3">
                            <a href="{{route('viewtraining',$training->slug)}}">
                            <h4>{{ucwords($training->title)}}</h4>
                            </a>
                            <span class="price">{{ucwords($training->author)}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

@endsection


