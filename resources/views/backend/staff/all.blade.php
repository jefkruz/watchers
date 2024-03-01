@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12 ">
            <div class="card">
                <div class="card-header">
                    <a href="{{route('staff.index')}}"  class="btn btn-info mt-1 float-right"><i class="fas fa-long-arrow-left"></i> Back</a>

                </div>
                <div class="card-body table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>#</th>

                            <th width="20%">NAME</th>
                            <th width="30%">EMAIL</th>
                            <th width="10%">PHONE</th>
                            <th width="10%">KINGSCHAT USERNAME</th>
                            <th>GENDER</th>
                            <th>CHURCH</th>
                            <th>ZONE</th>
                            <th>BIRTHDAY</th>
                            <th>NATIONALITY</th>


                        </tr>
                        </thead>
                        <tbody>
                        @foreach($members as $i => $member)
                            <tr>
                                <td>{{$i + 1}}</td>

                                <td>
                                    {{$member->name}}
                                </td>
                                <td>{{$member->email}}</td>
                                <td>{{$member->phone}}</td>
                                <td>{{$member->kc_username}}</td>
                                <td>{{$member->gender}}</td>
                                <td>{{$member->church}}</td>

                                <td>{{$member->zone}}</td>

                                <td>
                                    @if ($member->birth_month)
                                        {{$member->birth_date}} {{ date('F', mktime(0, 0, 0, $member->birth_month, 1)) }}
                                        @endif</td>

                                <td>{{$member->country}}</td>
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
    <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endsection

@section('script')
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <!-- DataTables  & Plugins -->

    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>

    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>

    <script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script>

    <script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>

    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.bootstrap4.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/pdfmake.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/vfs_fonts.js"></script>

    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>

    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>

    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.colVis.min.js"></script>

    <script>
        $(function () {
            $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": [ "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        });
    </script>
@endsection
