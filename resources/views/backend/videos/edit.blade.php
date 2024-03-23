@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center"><small>Title: </small>{{$blog->name}}</h4>
                </div>
                <div class="card-body">
                    <form method="post" action="{{route('videos.update', $blog->id)}}">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="">Video Title</label>
                                    <input type="text" class="form-control" name="title" value="{{$blog->name}}" placeholder="Video Title" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Video Status</label>
                                    <select name="status" class="form-control" >
                                        <option value="">--Set Status--</option>
                                        <option {{($blog->status == 'active') ? 'selected' : ''}} value="active">Active</option>
                                        <option {{($blog->status == 'inactive') ? 'selected' : ''}} value="inactive">Inactive</option>
                                    </select>
                                </div>
                            </div>



                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-dark fa-pull-right"><i class="fa fa-save"></i> Update Video</button>
                            </div>
                        </div>

                    </form>


                </div>
            </div>
        </div>
    </div>
    @endsection

@section('style')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>
        $('.summernote').summernote();
    </script>
@endsection
