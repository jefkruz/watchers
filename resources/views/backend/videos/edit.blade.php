@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center"><small>Title: </small>{{$blog->title}}</h4>
                </div>
                <div class="card-body">
                    <form method="post" action="{{route('posts.update', $blog->id)}}">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="">Blog Title</label>
                                    <input type="text" class="form-control" name="title" value="{{$blog->title}}" placeholder="Blog Title" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Blog Type</label>
                                    <select name="blog_type" class="form-control" disabled>
                                        <option value="">--Select Type--</option>
                                        <option {{($blog->type == 'text') ? 'selected' : ''}} value="text">Article Blog</option>
                                        <option {{($blog->type == 'audio') ? 'selected' : ''}} value="audio">Audio Blog</option>
                                    </select>
                                </div>
                            </div>

                            @if($blog->type == 'text')
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Content</label>
                                    <textarea name="post_body" class="summernote" required>{{$blog->content}}</textarea>
                                </div>
                            </div>
                            @endif


                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-dark fa-pull-right"><i class="fa fa-save"></i> Update Post</button>
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
