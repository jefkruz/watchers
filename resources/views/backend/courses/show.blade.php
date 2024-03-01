@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-4">

            <div class="card card-widget widget-user-2">
                <div class="widget-user-header bg-dark">
                    <!-- /.widget-user-image -->
                    <h3 class="widget-user-username">{{$course->title}}</h3>
                    @if($course->category == 'family')
                        <h5 class="widget-user-desc"><small class="text-warning">Job Family:</small> {{$course->family()->name}}</h5>
                        @endif
                    <h5 class="widget-user-desc"><small class="text-warning">Type:</small> {{strtoupper($course->course_type)}}</h5>
                    <h5 class="widget-user-desc"><small class="text-warning">Accessibility:</small> {{($course->accessibility == 'all') ? 'EVERYONE' : 'DEPARTMENT HEADS'}}</h5>

                    @if($course->status == 'inactive')

                    <h5 class="widget-user-desc"><span class="right badge badge-danger">{{strtoupper($course->status)}}</span></h5>
                        @else
                    <h5 class="widget-user-desc"><span class="right badge badge-info">{{strtoupper($course->status)}}</span></h5>
                    @endif
                </div>
                @if($course->thumbnail)
                <div class="card-body">
                    <img src="{{url($course->thumbnail)}}" class="img-fluid">
                </div>
                @endif
                <div class="card-footer p-0">
                    <ul class="nav flex-column">
                        @if($course->status == 'inactive')
                        <li class="nav-item">
                            <button form="activateForm" type="submit" class="btn btn-block bg-purple">
                                <i class="fa fa-check-circle"></i> ACTIVATE COURSE
                            </button>
                            <form id="activateForm" action="{{route('courses.activate', $course->id)}}" method="post">
                                @csrf
                                @method('PATCH')
                            </form>
                        </li>
                        @endif
                        @if($course->course_type != 'free')
                            <li class="nav-item">
                                <a class="nav-link text-dark">
                                    <small>Price in Naira:</small>
                                    <div>
                                        N {{ $course->course_fee_naira }}
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-dark">
                                    <small>Price in USD:</small>
                                    <div>
                                        $ {{ $course->course_fee_dollar }}
                                    </div>
                                </a>
                            </li>
                            @endif
                        <li class="nav-item">
                            <a class="nav-link text-dark">
                                <small>Description:</small>
                                <div>
                                    {!! $course->description !!}
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <button data-toggle="modal" data-target="#editCourseModal" class="btn btn-block bg-primary">
                                <i class="fa fa-edit"></i> EDIT COURSE
                            </button>
                        </li>
                        <li class="nav-item">
                            <form method="POST" action="{{route('courses.delete',$course->id)}}" onsubmit="return confirm('Are You sure you want to delete')">
                                {{ csrf_field() }}

                                <button type="submit" class="btn btn-block bg-danger "><i class="fas fa-trash"></i> Delete</button>
                            </form>

                        </li>
                    </ul>
                </div>
            </div>

        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <button data-toggle="modal" data-target="#newChapterModal" class="btn btn-dark btn-sm"><i class="fa fa-plus"></i> Add Chapter</button>
                            <button id="saveArrangementBtn" class="btn btn-info btn-sm fa-pull-right"><i class="fa fa-save"></i> Save Chapter Arrangement</button>
                        </div>

                        <div class="col-md-6 offset-md-3 mb-3" id="saveProgress" style="display: none">
                            <div class="alert alert-info text-center"><i class="fa fa-check"></i> Chapter arrangement saved</div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <div id="accordion" class="sortable">

                                @foreach($course->chapters() as $chapter)
                                <div class="card" id="item-{{$chapter->id}}">
                                    <a class="card-link" data-toggle="collapse" href="#collapse-{{$chapter->id}}">
                                    <div class="card-header bg-gray">

                                            {{$chapter->name}}
                                        <i class="fa fa-caret-right"></i>

                                        <small class="fa-pull-right"><i class="fa fa-bars"></i> Drag to reorder</small>

                                    </div>
                                    </a>
                                    <div id="collapse-{{$chapter->id}}" class="collapse" data-parent="#accordion">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12 mb-3">

                                                    <button data-id="{{$chapter->id}}" data-title="{{$chapter->name}}" class="btn btn-outline-dark btn-sm newMaterialBtn">Add Course Material</button>
{{--                                                    <a href="{{route('coursematerials.create', [$course->id, $chapter->id])}}" class="btn btn-outline-dark btn-sm">Add Course Material</a>--}}
                                                    <form method="POST" action="{{route('chapters.delete',$chapter->id)}}" onsubmit="return confirm('Are You sure you want to delete')">
                                                        {{ csrf_field() }}

                                                        <button type="submit" class="btn btn-outline-danger btn-sm  mt-1"><i class="fas fa-trash"></i>Delete </button>
                                                    </form>
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <ul class="list-group">
                                                        @foreach($chapter->materials() as $mat)
                                                        <li class="list-group-item">
                                                            <div class="media">
                                                                <img src="{{($course->thumbnail) ? url($course->thumbnail) : ''}}" class="mr-3" width="60px" alt="">
                                                                <div class="media-body">
                                                                    <h5 class="mt-0">{{$mat->title}}</h5>
                                                                    <input id="desc-{{$mat->id}}" type="hidden" value="{{$mat->description}}">
                                                                    <button data-link="{{$mat->link}}" data-title="{{$mat->title}}" data-id="desc-{{$mat->id}}" class="btn btn-sm btn-dark fa-pull-right viewMaterialBtn">View</button>

                                                                </div>
                                                            </div>

                                                        </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                @endforeach

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editCourseModal" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Course</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editCourseForm" action="{{route('courses.update', $course->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Course Title</label>
                                            <input type="text" class="form-control" name="title" value="{{$course->title}}" placeholder="e.g Chapter One" required>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Course Description</label>
                                            <textarea name="description" class="summernote" required>{{$course->description}}</textarea>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <img id="imgDisplay" src="{{($course->thumbnail) ? url($course->thumbnail) : ''}}" class="img-fluid">
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Course Image</label>
                                            <input type="file" name="thumbnail" id="courseThumbnail" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" form="editCourseForm" class="btn btn-dark">Save Changes</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="newChapterModal" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add New Chapter</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="chapterForm" action="{{route('chapters.store')}}" method="post">
                        @csrf
                        <input type="hidden" name="course_id" value="{{$course->id}}" required>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Chapter Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="e.g Chapter One" required>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" form="chapterForm" class="btn btn-dark">Create</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="newMaterialModal" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Upload New Material to <span id="matTitle"></span></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="">Video Title</label>
                                    <input type="text" class="form-control" id="newTitle" placeholder="Material Title">
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="">Video Description</label>
                                    <textarea name="description" id="newDescription" class="summernote"></textarea>
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="">Course Material</label>
                                    <div id="dropzoneDragArea" class="dropzone dz-default dz-message dropzoneDragArea"></div>
                                </div>
                            </div>

                        </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button id="addMaterialBtn" class="btn btn-dark">Add Material</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="viewMaterialModal" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalTitle"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <video id="video" class="video-js"></video>
                        </div>
                        <div class="col-md-12">
                            <div id="modalDesc"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    @endsection

@section('style')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link href="https://vjs.zencdn.net/8.3.0/video-js.css" rel="stylesheet" />
    <link href="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone.css" rel="stylesheet" type="text/css" />
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js" integrity="sha512-57oZ/vW8ANMjR/KQ6Be9v/+/h6bq9/l3f0Oc7vn6qMqyhvPd1cvKBRWWpzu0QoneImqr2SkmO4MSqU+RpHom3Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script src="https://vjs.zencdn.net/8.3.0/video.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.js" integrity="sha512-9e9rr82F9BPzG81+6UrwWLFj8ZLf59jnuIA/tIf8dEGoQVu7l5qvr02G/BiAabsFOYrIUTMslVN+iDYuszftVQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        const newMaterialBtn = $('.newMaterialBtn');
        const viewMaterialBtn = $('.viewMaterialBtn');
        const newMaterialModal = $('#newMaterialModal');
        const viewMaterialModal = $('#viewMaterialModal');
        const progress = $('#progress');
        const progressText = $('#progressText');
        const progressDiv = $('#progressDiv');
        const addMaterialBtn = $('#addMaterialBtn');
        const newTitle = $('#newTitle');
        const newDescription = $('#newDescription');
        const videoInput = $('#videoInput');

        const courseThumbnail = $('#courseThumbnail');
        const imgDisplay = $('#imgDisplay');

        const saveArrangementBtn = $('#saveArrangementBtn');
        const saveProgress = $('#saveProgress');

        Dropzone.autoDiscover = false;
        const token = '{{csrf_token()}}';

        let sort = $('.sortable').sortable();

        let chapterID;

        $('.summernote').summernote();

        let player = videojs('video', {
            fluid: true,
            controls: true
        });


        saveArrangementBtn.on('click', function(){
            const sortable_data = sort.sortable('serialize');
            console.log(sortable_data);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                }
            });
            $.ajax({
                method: "patch",
                data: sortable_data,
                url: "{{route('ajaxSaveChapterArrangement', $course->id)}}",
                success: function(data){
                    if(data.status === true){
                        saveProgress.show(500);
                        setTimeout(function(){
                            saveProgress.hide(500);
                        }, 3000);
                    }
                },
                error: function(err){
                    console.log(err);
                }
            });
        });

        newMaterialBtn.on('click', function(){
            const chapter = $(this).data('id');
            const title = $(this).data('title');
            chapterID = chapter;
            $('#matTitle').html(title);
            newMaterialModal.modal();
        });

        viewMaterialBtn.on('click', function(){
            const id = $(this).data('id');
            const title = $(this).data('title');
            const link = $(this).data('link');
            const desc = $('#' + id).val();
            const source = {
                src: link,
                type: 'video/mp4'
            };
            player.src(source);
            $('#modalDesc').html(desc);
            $('#modalTitle').html(title);
            $('#vidSource').attr('src', link);
            viewMaterialModal.modal();
        });

        courseThumbnail.on('change', function(e){
            const file = e.target.files[0];
            const accepted = ['image/jpg', 'image/jpeg', 'image/png'];
            if(accepted.includes(file.type)){
                const fr = new FileReader();

                fr.onload = () => {
                    imgDisplay.attr('src', fr.result);
                };

                fr.readAsDataURL(file);
            }
        });

        $(function() {
            var myDropzone = new Dropzone("div#dropzoneDragArea", {
                paramName: "file",
                url: "{{ route('ajaxUploadMaterial') }}",
                // previewsContainer: 'div.dropzone-previews',
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
                        // let chapterID = document.getElementById('chapter_id').value;
                        let courseID = '{{$course->id}}';
                        formData.append('chapter', chapterID);
                        formData.append('course', courseID);
                        formData.append('title', newTitle.val());
                        formData.append('description', newDescription.val());
                    });

                    this.on("success", function (file, response) {
                        console.log(response);
                        if(response.status === true){
                            location.reload();
                        }
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
