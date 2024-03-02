@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="{{route('sendNotification')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Notification Title</label>
                                    <input type="text" class="form-control" name="title" id="notifTitle" placeholder="Notification Title" required>
                                </div>
                            </div>

                            <div class="col-md-12" >
                                <div class="form-group">
                                    <label for="">Notification Body</label>
                                    <textarea name="body" id="notifBody" class="form-control" required></textarea>
                                </div>
                            </div>

                            <div class="col-md-12 mb-5" id="previewNotif" style="display: none">
                                <span>Preview</span>
                                <div class="media" style="border: 3px dotted grey">
                                    <img class="mr-3" src="{{url('images/favicon.png')}}" alt="Generic placeholder image">
                                    <div class="media-body">
                                        <h5 class="mt-0" id="titleDisplay"></h5>
                                        <span id="bodyDisplay"></span>
                                    </div>
                                </div>
                            </div>




                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-dark fa-pull-right"><i class="fa fa-paper-plane"></i> Send Notification</button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
    @endsection

@section('style')
@endsection

@section('script')
    <script>
        const notifTitle = $('#notifTitle');
        const notifBody = $('#notifBody');
        const titleDisplay = $('#titleDisplay');
        const bodyDisplay = $('#bodyDisplay');
        const previewNotif = $('#previewNotif');

        notifTitle.on('keyup', function(){
            previewNotif.show(500);
            const text = $(this).val();
            titleDisplay.html(text);
        });

        notifBody.on('keyup', function(){
            previewNotif.show(500);
            const text = $(this).val();
            bodyDisplay.html(text);
        });
    </script>
@endsection
