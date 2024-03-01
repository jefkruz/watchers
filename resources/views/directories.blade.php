@extends('layouts.app')

@section('content')
<div class="row">
    @if ($meeting)
    <div class="col-md-6">
        <div class="card">

            @if($meeting->image)
                <img class="card-img-top img-fluid" src="{{url($meeting->image)}}" alt="{{$meeting->title}}">
            @endif
                <div class="card-header">
                    <h5 class="card-title">{{$meeting->title}}</h5>
                </div>
        </div>
    </div>
    @endif
    <div class="col-md-6">
        <div class="card">
            <div class="card-header d-block">
{{--                <h4 class="card-title">1 - FIND A LOVEWORLD NETWORK STATION TO PARTICIPATE</h4>--}}
            </div>
            <div class="card-body">

                <div class="accordion accordion-primary-solid" id="accordion-two">

                    <div class="accordion-item">
                        <div class="accordion-header rounded-lg collapsed" id="accord-2One" data-bs-toggle="collapse" data-bs-target="#collapse2One" aria-controls="collapse2One" aria-expanded="false" role="button">
                            <span class="accordion-header-text">1 - FIND A LOVEWORLD NETWORK STATION TO PARTICIPATE</span>
                            <span class="accordion-header-indicator"></span>
                        </div>
                        <div id="collapse2One" class="accordion__body collapse" aria-labelledby="accord-2One" data-bs-parent="#accordion-two" style="">


                            <div class="accordion-body-text">
                                <div class="table-responsive">
                                    <table class="table table-hover table-responsive-sm">
                                        <thead>
                                        <tr>

                                            <th>
                                                #
                                            </th>
                                            <th>
                                                Name
                                            </th>
                                            <th>
                                                Country
                                            </th>
                                            <th>
                                                Link
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($stations as $i =>$station)
                                            <tr>
                                                <td>
                                                    {{++$i}}
                                                </td>
                                                <td class="text-danger">
                                                    {{$station->name}}
                                                </td>
                                                <td>
                                                    {{$station->country}}
                                                </td>
                                                <td>
                          <span class="badge  btn-sm  btn-rounded btn-dark ">
                              <a href="{{$station->link}}" class="text-white"><i class="fas fa-tv"></i> Watch</a>
                          </span>
                                                </td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>

                                </div>

                            </div>

                        </div>
                    </div>

                    <div class="accordion-item">
                        <div class="accordion-header collapsed rounded-lg" id="accord-2Two" data-bs-toggle="collapse" data-bs-target="#collapse2Two" aria-controls="collapse2Two" aria-expanded="false" role="button">
                            <span class="accordion-header-text">2 - FIND A WEBSITE TO PARTICIPATE</span>
                            <span class="accordion-header-indicator"></span>
                        </div>
                        <div id="collapse2Two" class="collapse accordion__body" aria-labelledby="accord-2Two" data-bs-parent="#accordion-two">
                            <div class="accordion-body-text">
                                <div class="table-responsive">
                                    <table class="table table-hover table-responsive-sm">
                                        <thead>
                                        <tr>

                                            <th>
                                                #
                                            </th>
                                            <th>
                                                Name
                                            </th>

                                            <th>
                                                Link
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($websites as $i =>$website)
                                            <tr>
                                                <td>
                                                    {{++$i}}
                                                </td>
                                                <td>
                                                    {{$website->name}}
                                                </td>

                                                <td>
                          <span class="badge btn-sm btn-dark ">
                              <a href="{{$website->link}}" class="text-white"><i class="fas fa-tv"></i> Watch</a>
                          </span>
                                                </td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>

                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <div class="accordion-header collapsed rounded-lg" id="accord-2Three" data-bs-toggle="collapse" data-bs-target="#collapse2Three" aria-controls="collapse2Three" aria-expanded="false" role="button">
                            <span class="accordion-header-text">3 - FIND AN APP TO PARTICIPATE</span>
                            <span class="accordion-header-indicator"></span>
                        </div>
                        <div id="collapse2Three" class="collapse accordion__body" aria-labelledby="accord-2Three" data-bs-parent="#accordion-two">
                            <div class="accordion-body-text">
                                <div class="table-responsive">
                                    <table class="table table-hover table-responsive-sm">
                                        <thead>
                                        <tr>

                                            <th>
                                                #
                                            </th>
                                            <th>
                                                Name
                                            </th>
                                            <th>
                                                Download
                                            </th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($apps as $i =>$app)
                                            <tr>
                                                <td>
                                                    {{++$i}}
                                                </td>
                                                <td>
                                                    {{$app->title}}
                                                </td>
                                                <td>
                          <span class="badge btn-sm btn-primary ">
                              <a href="{{$app->links}}" class="text-white"> <i class="fas fa-download"></i> GET</a>
                          </span>
                                                </td>

                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>

                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <div class="accordion-header collapsed rounded-lg" id="accord-2Four" data-bs-toggle="collapse" data-bs-target="#collapse2Four" aria-controls="collapse2Four" aria-expanded="false" role="button">
                            <span class="accordion-header-text">4 - FIND A LOCAL TV STATION TO PARTICIPATE</span>
                            <span class="accordion-header-indicator"></span>
                        </div>
                        <div id="collapse2Four" class="collapse accordion__body" aria-labelledby="accord-2Four" data-bs-parent="#accordion-two">
                            <div class="accordion-body-text">
{{--                                <table class="table table-hover table-responsive">--}}
{{--                                    <thead>--}}
{{--                                    <tr>--}}

{{--                                        <th>--}}
{{--                                            #--}}
{{--                                        </th>--}}
{{--                                        <th>--}}
{{--                                            Name--}}
{{--                                        </th>--}}
{{--                                        <th>--}}
{{--                                            Download--}}
{{--                                        </th>--}}

{{--                                    </tr>--}}
{{--                                    </thead>--}}
{{--                                    <tbody>--}}
{{--                                    @foreach($apps as $i =>$app)--}}
{{--                                        <tr>--}}
{{--                                            <td>--}}
{{--                                                {{++$i}}--}}
{{--                                            </td>--}}
{{--                                            <td>--}}
{{--                                                {{$app->title}}--}}
{{--                                            </td>--}}
{{--                                            <td>--}}
{{--                          <span class="badge btn-sm btn-primary ">--}}
{{--                              <a href="{{$app->links}}" class="text-white"> <i class="fas fa-download"></i> GET</a>--}}
{{--                          </span>--}}
{{--                                            </td>--}}

{{--                                        </tr>--}}
{{--                                    @endforeach--}}

{{--                                    </tbody>--}}
{{--                                </table>--}}

                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <div class="accordion-header collapsed rounded-lg" id="accord-2Five" data-bs-toggle="collapse" data-bs-target="#collapse2Five" aria-controls="collapse2Five" aria-expanded="false" role="button">
                            <span class="accordion-header-text">5 - FIND A LOCAL RADIO STATION TO PARTICIPATE</span>
                            <span class="accordion-header-indicator"></span>
                        </div>
                        <div id="collapse2Five" class="collapse accordion__body" aria-labelledby="accord-2Five" data-bs-parent="#accordion-two">
                            <div class="accordion-body-text">
{{--                                <table class="table table-hover table-responsive">--}}
{{--                                    <thead>--}}
{{--                                    <tr>--}}

{{--                                        <th>--}}
{{--                                            #--}}
{{--                                        </th>--}}
{{--                                        <th>--}}
{{--                                            Name--}}
{{--                                        </th>--}}
{{--                                        <th>--}}
{{--                                            Download--}}
{{--                                        </th>--}}

{{--                                    </tr>--}}
{{--                                    </thead>--}}
{{--                                    <tbody>--}}
{{--                                    @foreach($apps as $i =>$app)--}}
{{--                                        <tr>--}}
{{--                                            <td>--}}
{{--                                                {{++$i}}--}}
{{--                                            </td>--}}
{{--                                            <td>--}}
{{--                                                {{$app->title}}--}}
{{--                                            </td>--}}
{{--                                            <td>--}}
{{--                          <span class="badge btn-sm btn-primary ">--}}
{{--                              <a href="{{$app->links}}" class="text-white"> <i class="fas fa-download"></i> GET</a>--}}
{{--                          </span>--}}
{{--                                            </td>--}}

{{--                                        </tr>--}}
{{--                                    @endforeach--}}

{{--                                    </tbody>--}}
{{--                                </table>--}}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
