@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-md-7 offset-md-2">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="{{route('videos.store')}}" enctype="multipart/form-data">
                        @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Video Title</label>
                                <input type="text" class="form-control" name="title" placeholder="Video Title" required>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Description</label>
                                <textarea name="description" class="summernote"></textarea>
                            </div>
                        </div>

                        <div  class="col-md-12" >
                            <div class="form-group">
                                <label for="">Select Video</label>
                                <input type="file" name="video" class="form-control">
                            </div>
                        </div>


                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-dark fa-pull-right"><i class="fa fa-save"></i> Upload</button>
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
