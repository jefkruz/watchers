@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="{{route('posts.store')}}" enctype="multipart/form-data">
                        @csrf
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="">Blog Title</label>
                                <input type="text" class="form-control" name="title" placeholder="Blog Title" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Blog Type</label>
                                <select name="blog_type" id="blog_type" class="form-control" required>
                                    <option value="">--Select Type--</option>
                                    <option value="text">Article Blog</option>
                                    <option value="audio">Audio Blog</option>
                                    <option value="video">Video Blog</option>
                                </select>
                            </div>
                        </div>

                        <div  id="contentInput" class="col-md-12" style="display: none">
                            <div class="form-group">
                                <label for="">Content</label>
                                <textarea name="post_body" class="summernote"></textarea>
                            </div>
                        </div>

                        <div id="fileInput" class="col-md-12" style="display: none">
                            <div class="form-group">
                                <label for="">Select Media/File</label>
                                <input type="file" name="file" class="form-control" id="mediaSelector">
                            </div>
                        </div>


                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-dark fa-pull-right"><i class="fa fa-save"></i> Create Post</button>
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
        const blogType = $('#blog_type');
        const contentInput = $('#contentInput');
        const fileInput = $('#fileInput');
        const mediaSelector = $('#mediaSelector');

        blogType.on('change', function(){
            const val = $(this).val();
            if(val === 'text'){
                contentInput.show();
                fileInput.hide();
            } else if(val === 'audio' || val === 'video'){
                mediaSelector.attr('accept', val + '/*');
                contentInput.hide();
                fileInput.show();
            } else {
                contentInput.hide();
                fileInput.hide();
            }
        });
    </script>
@endsection
