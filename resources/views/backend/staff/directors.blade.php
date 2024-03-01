@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-body table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>NAME</th>
                            <th>DEPARTMENT</th>
                            <th>ACTION</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($members as $i => $mem)
                            @php
                            $member = $mem->profile();
                            @endphp
                            <tr>
                                <td>{{$i + 1}}</td>
                                <td>
                                    {{$member->title}} {{$member->firstname}} {{$member->lastname}}
                                </td>
                                <td>{{$member->department()->name}}</td>
                                <td><a href="{{route('staff.show', $member->id)}}" class="btn btn-sm btn-primary">View</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endsection

@section('style')
@endsection

@section('script')
@endsection
