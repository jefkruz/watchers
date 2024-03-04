@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-10 ">
            <div class="card">
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-12">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>USER</th>
                                    <th>IP ADDRESS</th>


                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($magazines as $i => $fam)
                                    <tr>
                                        <td>{{$i + 1}}</td>

                                        <td>
                                            {{ucwords($fam->user->name)}}
                                        </td>
                                        <td>
                                            {{$fam->ip_address}}
                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

