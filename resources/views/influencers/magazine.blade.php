@extends('layouts.main')



@section('content')

    <div class="row">
        @foreach($magazines as $magazine)
        <div class="col-xl-3 col-lg-6 col-md-4 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="new-arrival-product">
                        <div class="new-arrivals-img-contnent">
                            <img class="img-fluid" src="{{asset($magazine->image)}}" alt="{{$magazine->name}}">
                        </div>
                        <div class="new-arrival-content text-center mt-3">
                            <h4>{{ucwords($magazine->month)}}</h4>

                                      <a  href="{{asset($magazine->file)}}" download="{{$magazine->file}}" class="btn btn-rounded btn-warning"><span class="btn-icon-start text-warning"><i class="fa fa-download color-warning"></i>
                                    </span>Download</a>
                            <a href="{{route('readMagazine',$magazine->id)}}" class="btn btn-rounded"><i class="fa fa-book-open"></i> Read Magazine </a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

    </div>
@endsection
