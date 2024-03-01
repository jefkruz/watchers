@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <button data-toggle="modal" data-target="#newSlideModal" class="btn btn-dark"><i class="fa fa-image"></i> Add Slide</button>
                        </div>
                        <div class="col-md-12">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>CAPTION</th>

                                    <th>ACTION</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($slides as $i => $fam)
                                    <tr>
                                        <td>{{$i + 1}}</td>
                                        <td>
                                            <img src="{{url($fam->photo)}}" width="100px">
                                            {{$fam->caption}}
                                        </td>
                                        <td>
                                            <form id="deleteForm-{{$fam->id}}" action="{{route('slides.delete', $fam->id)}}" method="post">
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
                    <h4 class="modal-title">Upload Slide Image</h4>
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
                                    <label for="">Select Image</label>
                                    <input type="file" name="file" class="form-control" accept="image/*" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Link</label>
                                    <input type="text" name="link" class="form-control"  required>
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
