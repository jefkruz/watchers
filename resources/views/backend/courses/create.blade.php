@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-3">
            <div id="previewDiv" style="display:none" class="card bg-navy">
                <div class="card-body">
                    <img src="" id="previewImage" class="img-fluid">
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('courses.store')}}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="">Course Title</label>
                                    <input type="text" class="form-control" name="title" required>
                                </div>
                            </div>

                            <div class="col-md-3 mb-3">
                                <div class="form-group">
                                    <label for="">Course Image</label>
                                    <input type="file" name="thumbnail" id="courseThumbnail" class="form-control" accept="image/*" required>
                                </div>
                            </div>

                            <div class="col-md-3 mb-3">
                                <div class="form-group">
                                    <label for="">Course Category</label>
                                    <select name="category"  class="form-control" required>
                                        <option value="">--Category--</option>
                                        <option value="general">General Course</option>
{{--                                        <option value="family">Job Family Course</option>--}}
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="">Course Accessibility</label>
                                    <select name="accessibility" class="form-control" required>
                                        <option value="">Who can have access to this course?</option>
                                        <option value="all">Every Influencer</option>
                                        <option value="heads">Team Leaders</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="">Course Description</label>
                                    <textarea name="description" class="summernote"></textarea>
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="">Course Type</label>
                                    <select name="course_type" id="course_type" class="form-control" required>
                                        <option value="">--Select type--</option>
                                        <option value="free">Free Course</option>
                                        <option value="subscription">Subscription Course</option>
                                        <option value="certification">Certification Course</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3 amountDiv" style="display: none">
                                <div class="form-group">
                                    <label for="">Amount in Naira</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                              N
                                            </span>
                                        </div>
                                        <input type="text" name="course_fee_naira" class="form-control amount">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3 amountDiv" style="display: none">
                                <div class="form-group">
                                    <label for="">Amount in USD</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                              <i class="fas fa-dollar-sign"></i>
                                            </span>
                                        </div>
                                        <input type="text" name="course_fee_dollar" class="form-control amount">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <button class="btn btn-dark fa-pull-right" type="submit">Create</button>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $('.summernote').summernote();
        $('.amount').mask('99999999999');

        const previewImage = $('#previewImage');
        const courseThumbnail = $('#courseThumbnail');
        const previewDiv = $('#previewDiv');



        $('#course_type').on('change', function(){
            const val = $(this).val();
            if(val === 'subscription' || val === 'certification'){
                $('.amountDiv').show(500);
            } else {
                $('.amountDiv').hide(500);
            }
        });

        courseThumbnail.on('change', function(e){
            const file = e.target.files[0];
            const accepted = ['image/jpg', 'image/jpeg', 'image/png'];
            if(accepted.includes(file.type)){
                const fr = new FileReader();

                fr.onload = () => {
                    previewImage.attr('src', fr.result);
                    previewDiv.show(500);
                };

                fr.readAsDataURL(file);
            }
        });
    </script>
@endsection
