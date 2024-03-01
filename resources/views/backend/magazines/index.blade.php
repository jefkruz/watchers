@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <button data-toggle="modal" data-target="#newSlideModal" class="btn btn-dark"><i class="fa fa-file-pdf"></i> Add Magazine</button>
                        </div>
                        <div class="col-md-12">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>CAPTION</th>
                                    <th>TITLE</th>
                                    <th>MONTH</th>
                                    <th>DOWNLOAD</th>

                                    <th>ACTION</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($magazines as $i => $fam)
                                    <tr>
                                        <td>{{$i + 1}}</td>
                                        <td>
                                            <img src="{{url($fam->image)}}" width="100px">

                                        </td>
                                        <td>
                                            {{ucwords($fam->name)}}
                                        </td>
                                        <td>
                                            {{$fam->month}}
                                        </td>
                                        <td>  <a  href="{{asset($fam->file)}}" download="{{$fam->file}}" class="btn  btn-warning"><i class="fa fa-download color-warning"></i>
                                   Download</a></td>
                                        <td>
                                            <form id="deleteForm-{{$fam->id}}" action="{{route('magazines.delete', $fam->id)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                            <button data-form="deleteForm-{{$fam->id}}" class="btn btn-danger btn-sm deleteBtn">Delete</button>
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

    <div class="modal fade" id="newSlideModal" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Upload Magazine</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="slideForm" action="" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input type="text" name="name" class="form-control"  required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Month</label>
                                    <select name="month" class="form-control">
                                        <option value="January">January</option>
                                        <option value="February">February</option>
                                        <option value="March">March</option>
                                        <option value="April">April</option>
                                        <option value="May">May</option>
                                        <option value="June">June</option>
                                        <option value="July">July</option>
                                        <option value="August">August</option>
                                        <option value="September">September</option>
                                        <option value="October">October</option>
                                        <option value="November">November</option>
                                        <option value="December">December</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Cover Image</label>
                                    <input type="file" name="image" class="form-control" accept="image/*" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Magazine</label>
                                    <input type="file" name="file" class="form-control" accept="application/pdf" required>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" form="slideForm" class="btn btn-primary">Save changes</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection

@section('style')
@endsection

@section('script')
    <script>
        const deleteBtn = $('.deleteBtn');

        deleteBtn.on('click', function(e){
            e.preventDefault();
            const fm = $(this).data('form');
            if(confirm('Are you sure you want to delete?')){
                $('#' + fm).submit();
            }
        });

    </script>
@endsection
