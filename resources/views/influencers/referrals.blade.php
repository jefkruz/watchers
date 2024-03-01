@extends('layouts.main')

@section('content')

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">My Team</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example3" class="display min-w850">
                                    <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Photo</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone Number</th>
                                        <th>Reg. Date</th>
                                        <th>Referrals</th>


                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($referrals as $user)
                                        @php $id=$user->id;
$referrals = \App\Models\User::where('referral_id',$id)->get();
                                        @endphp
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>
                                            @if ($user->avatar != '')
                                            <img class="rounded-circle" width="35" src="{{asset( 'storage/'.$user->avatar)}}" alt=""></td>
                                        @else
                                            <img class="rounded-circle" width="35" src="{{asset( 'storage/users/default.png')}}" alt=""></td>

                                        @endif
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->phone}}</td>

                                        <td>{{  date('j \\ F Y', strtotime($user->created_at)) }}</td>
                                        <td>
                                            @if($referrals->count()>0)
                                                <span  class="badge light badge-danger ">


                                                    {{ $referrals->count() }} Referrals
                                                </span>
                                            @else None
                                            @endif
                                        </td>
                                        <td >
                                            <a class="btn btn-sm btn-rounded btn-info " href="{{ route('view',$user->username) }}"><i class="fas fa-eye"></i> View</a>

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

            @include('includes.main.data')
@endsection

