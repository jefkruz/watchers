@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="{{route('resources.update', $res->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Post Title</label>
                                    <input type="text" class="form-control" name="title" value="{{$res->title}}" placeholder="Post Title" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Post Accessibility</label>
                                    <select name="accessibility" class="form-control" required>
                                        <option value="{{$res->accessibility}}">{{$res->accessibility}}</option>
                                        <option value="all">Every Influencer</option>
                                        <option value="heads">Team Leaders</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Content</label>
                                    <textarea name="post_body" class="summernote">{{$res->content}}</textarea>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="">Select Featured Image</label>
                                    <input type="file" name="file" class="form-control" id="imageSelect" accept="image/*">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <img id="displayImage" src="{{($res->image ? url($res->image) : '')}}" class="img-fluid">
                            </div>


                        </div>

                        <div class="row mt-3">
                            <div class="col-md-12">
                                <button class="btn btn-dark fa-pull-right"><i class="fa fa-save"></i> Update</button>
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
        const displayImage = $('#displayImage');
        const imageSelect = $('#imageSelect');

        imageSelect.on('change', function(e){
            const file = e.target.files[0];

            const accepted = ['image/jpg', 'image/jpeg', 'image/png'];
            if(accepted.includes(file.type)){
                const fr = new FileReader();

                fr.onload = () => {
                    displayImage.attr('src', fr.result);
                };

                fr.readAsDataURL(file);
            }
        });

    </script>
@endsection
