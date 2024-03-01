@extends('layouts.main')

@section('content')

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">My Participants</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example3" class="display min-w850">
                                    <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Name</th>
                                        <th>Email</th>

                                        <th>Reg. Date</th>

{{--                                        <th>Action</th>--}}
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($participants as $user)
                                    <tr>
                                        <td>{{$i++}}</td>

                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>

                                        <td>{{  date('j \\ F Y', strtotime($user->created_at)) }}</td>

{{--                                        <td >--}}
{{--                                            <a class="btn btn-sm btn-rounded btn-info " href="{{ route('view',$user->username) }}"><i class="fas fa-eye"></i> View</a>--}}

{{--                                        </td>--}}

                                    </tr>

                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @include('includes.main.data')
@endsection

