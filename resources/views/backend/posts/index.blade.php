@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <a href="{{route('posts.create')}}" class="btn btn-sm btn-dark">Create Post</a>
                        </div>
                        <div class="col-md-12 mb-3 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>TITLE</th>
                                        <th>POST TYPE</th>
                                        <th>DATE POSTED</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($posts as $i => $post)
                                    <tr>
                                        <td>{{$i + 1}}</td>
                                        <td>{{$post->title}}</td>
                                        <td>{{strtoupper($post->type)}}</td>
                                        <td>{{$post->created_at->diffForHumans()}}</td>
                                        <td>
                                            <a href="{{route('posts.edit', $post->id)}}" class="btn btn-sm btn-success"><i class="fa fa-edit"></i> Edit</a>
                                            <form method="POST" action="{{route('posts.delete',$post->id)}}" onsubmit="return confirm('Are You sure you want to delete')">
                                                {{ csrf_field() }}

                                                <button type="submit" class="btn  btn-sm btn-danger mt-1"><i class="fas fa-trash"></i>Delete </button>
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
    @endsection

@section('style')
@endsection

@section('script')
@endsection
