@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label for="">Title</label>
                                <input type="text" class="form-control" id="newTitle" placeholder="Material Title">
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label for="">Course Description</label>
                                <textarea name="description" id="newDescription" class="summernote"></textarea>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label for="">Course Material</label>
                                <div id="dropzoneDragArea" class="dropzone"></div>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <button id="addMaterialBtn" class="btn btn-dark fa-pull-right">Add Material</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection

@section('style')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link href="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone.css" rel="stylesheet" type="text/css" />
{{--    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />--}}
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.js" integrity="sha512-9e9rr82F9BPzG81+6UrwWLFj8ZLf59jnuIA/tIf8dEGoQVu7l5qvr02G/BiAabsFOYrIUTMslVN+iDYuszftVQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>--}}

    <script>
        Dropzone.autoDiscover = false;
        const token = '{{csrf_token()}}';
        const addMaterialBtn = $('#addMaterialBtn');
        const newTitle = $('#newTitle');
        const newDescription = $('#newDescription');
        $('.summernote').summernote();

        $(function() {
            var myDropzone = new Dropzone("div#dropzoneDragArea", {
                paramName: "file",
                url: "{{ route('ajaxUploadMaterial') }}",
                addRemoveLinks: true,
                autoProcessQueue: false,
                uploadMultiple: false,
                parallelUploads: 1,
                maxFiles: 1,
                params: {
                    _token: token
                },
                // The setting up of the dropzone
                init: function() {
                    var myDropzone = this;
                    //form submission code goes here
                    addMaterialBtn.on('click', function(event) {
                        event.preventDefault();
                        myDropzone.processQueue();
                    });

                    //Gets triggered when we submit the image.
                    this.on('sending', function(file, xhr, formData){
                        //fetch the user id from hidden input field and send that userid with our image
                        let chapterID = '{{$chapter->id}}';
                        let courseID = '{{$course->id}}';
                        formData.append('chapter', chapterID);
                        formData.append('course', courseID);
                        formData.append('title', newTitle.val());
                        formData.append('description', newDescription.val());
                    });

                    this.on("success", function (file, response) {
                        console.log(response);
                        //reset dropzone
                        $('.dropzone-previews').empty();
                    });

                    this.on("queuecomplete", function () {

                    });

                    // Listen to the sendingmultiple event. In this case, it's the sendingmultiple event instead
                    // of the sending event because uploadMultiple is set to true.
                    this.on("sendingmultiple", function() {
                        // Gets triggered when the form is actually being sent.
                        // Hide the success button or the complete form.
                    });

                    this.on("successmultiple", function(files, response) {
                        // Gets triggered when the files have successfully been sent.
                        // Redirect user or notify of success.
                    });

                    this.on("errormultiple", function(files, response) {
                        // Gets triggered when there was an error sending the files.
                        // Maybe show form again, and notify user of error
                    });
                }
            });
        });
    </script>
@endsection
