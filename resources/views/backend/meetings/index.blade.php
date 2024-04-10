@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12 ">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <button data-toggle="modal" data-target="#newMeetingModal" class="btn btn-dark btn-sm">Create Programme</button>
                        </div>
                        <div class="col-md-12">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>NAME</th>
                                    <th>STREAM LINK</th>
                                    <th>START</th>
                                    <th>END</th>

                                    <th><i class="fa fa-tv"></i></th>
                                    <th>ACTIONS</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($programmes as $i => $fam)
                                    <tr>
                                        <td>{{$i + 1}}</td>
                                        <td>{{$fam->title}}</td>
                                        <td>{{$fam->stream_link}}</td>
                                        <td><span class="startTime" data-seconds="{{$fam->startSeconds}}"></span></td>
                                        <td><span class="endTime" data-seconds="{{$fam->endSeconds}}"></span></td>
                                        <td><a href="{{$fam->stream_link}}" class="btn btn-sm btn-dark"><i class="fa fa-tv"></i></a></td>
                                        <td>
                                            <a href="{{route('meetings.manage',$fam->id)}}" class="btn  btn-sm btn-primary mt-1">{{ $fam->getAttendanceCount() }} <i class="fas fa-users"></i></a>
                                            <form method="POST" action="{{route('meetings.delete',$fam->id)}}" onsubmit="return confirm('Are You sure you want to delete')">
                                                {{ csrf_field() }}

                                                <button type="submit" class="btn  btn-sm btn-danger mt-1"><i class="fas fa-trash"></i> Delete</button>
                                            </form>
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

    <div class="modal fade" id="newMeetingModal" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add New Programme</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="meetingForm" action="{{route('meetings.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Programme Title</label>
                                    <input type="text" class="form-control" name="title" placeholder="Programme Title" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Select Image</label>
                                    <input type="file" name="file" class="form-control"  required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Programme Accessibility</label>
                                    <select name="accessibility" class="form-control" required>
                                        <option value="">Who can have access to this Programme?</option>
                                        <option value="all">Every Influencer</option>
                                        <option value="heads">Team Leaders</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Stream Link</label>
                                    <select name="stream_link"  class="form-control" required>
                                        @foreach($streams as $stream)
                                        <option value="{{$stream->link}}">{{$stream->name}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Start Date</label>
                                    <input type="text" id="start_date" class="form-control" placeholder="Start Date" required>
                                    <input type="hidden" name="start_date" id="start_timestamp" required>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">End Date</label>
                                    <input type="text" id="end_date" class="form-control" placeholder="End Date" required>
                                    <input type="hidden" name="end_date" id="end_timestamp" required>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button id="submitBtn" class="btn btn-dark">Create</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    @endsection

@section('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@eonasdan/tempus-dominus@6.7.7/dist/css/tempus-dominus.min.css" crossorigin="anonymous">
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha256-BRqBN7dYgABqtY9Hd4ynE+1slnEw+roEPFzQ7TRRfcg=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@eonasdan/tempus-dominus@6.7.7/dist/js/tempus-dominus.min.js" crossorigin="anonymous"></script>
    <script>
        new tempusDominus.TempusDominus(document.getElementById('start_date'), {
            localization: {
                format: 'yyyy-MM-dd HH:mm:00'
            },
        });

        new tempusDominus.TempusDominus(document.getElementById('end_date'), {
            localization: {
                format: 'yyyy-MM-dd HH:mm:00'
            },
        });

        const form = $('#meetingForm');
        const submitBtn = $('#submitBtn');

        submitBtn.on('click', function(e){
            e.preventDefault();
            const startDate = $('#start_date').val().trim();
            const endDate = $('#end_date').val().trim();

            const startTimeStamp = $('#start_timestamp');
            const endTimeStamp = $('#end_timestamp');

            if(startDate.length && endDate.length){
                startTimeStamp.val(new Date(startDate).getTime());
                endTimeStamp.val(new Date(endDate).getTime());
                form.submit();
            }
        });

        const startSeconds = $('.startTime');
        const endSeconds = $('.endTime');
        for(let i = 0; i < startSeconds.length; i++){
            const sec = startSeconds[i].dataset.seconds;
            const date = new Date(sec * 1000);
            startSeconds[i].outerText = renderTime(date);
        }
        for(let j = 0; j < endSeconds.length; j++){
            const sec = endSeconds[j].dataset.seconds;
            const date = new Date(sec * 1000);
            endSeconds[j].outerText = renderTime(date);
        }

        function renderTime(date){
            const months = [
                'January',
                'February',
                'March',
                'April',
                'May',
                'June',
                'July',
                'August',
                'September',
                'October',
                'November',
                'December'
            ];

            const month = months[date.getMonth()];
            const day = date.getDate();
            const year = date.getFullYear();
            const minutes = date.getMinutes() > 9 ? date.getMinutes() : '0' + date.getMinutes();
            const hour = date.getHours() > 12 ? date.getHours() - 12 : (date.getHours() === 0 ? 12 : date.getHours());
            const suffix = date.getHours() >= 12 ? 'PM' : 'AM';

            return `${month} ${day}, ${year} - ${hour}:${minutes}${suffix}`;

        }
    </script>
@endsection
