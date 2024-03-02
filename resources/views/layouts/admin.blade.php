<?php
$dash_menu = isset($dash_menu) ? 'active' : '';
$training_menu = isset($training_menu) ? 'active' : '';
$notif_menu = isset($notif_menu) ? 'active' : '';
$slides_menu = isset($slides_menu) ? 'active' : '';
$meet_menu = isset($meet_menu) ? 'active' : '';
$birthday_menu = isset($birthday_menu) ? 'active' : '';
$guest_menu = isset($guest_menu) ? 'active' : '';
$post_menu = isset($post_menu) ? 'active' : '';
$forum_menu = isset($forum_menu) ? 'active' : '';
$resource_menu = isset($resource_menu) ? 'active' : '';
$staff_menu = isset($staff_menu) ? 'active' : '';
$leader_menu = isset($leader_menu) ? 'active' : '';
$campus_menu = isset($campus_menu) ? 'active' : '';
$zone_menu = isset($zone_menu) ? 'active' : '';
$magazine_menu = isset($magazine_menu) ? 'active' : '';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{$page_title}} .:. Watchers Admin</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Theme style -->
    <link rel="stylesheet" href="{{url('admin_assets/css/adminlte.min.css')}}">

    @yield('style')
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->

        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>


        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">

            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-user-circle"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-item dropdown-header">{{session('admin')->name}}</span>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-key mr-2"></i> Security Settings
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{route('logout')}}" class="dropdown-item dropdown-footer">Logout</a>
                </div>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{route('adminDashboard')}}" class="brand-link">
            <img src="{{url('images/favicon.png')}}" alt="" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">Watchers Admin</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{url('avatar/default.png')}}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">{{session('admin')->name}}</a>
                </div>
            </div>


            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <a href="{{route('adminDashboard')}}" class="nav-link {{$dash_menu}}">
                            <i class="nav-icon fa fa-tachometer"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('guests.index')}}" class="nav-link {{$guest_menu}}">
                            <i class="nav-icon fa fa-users"></i>
                            <p>
                                Participants
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('staff.index')}}" class="nav-link {{$staff_menu}}">
                            <i class="nav-icon fa fa-users"></i>
                            <p>
                                Influencers
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('user.teamHeads')}}" class="nav-link {{$leader_menu}}">
                            <i class="nav-icon fa fa-person-chalkboard"></i>
                            <p>
                                Team Heads
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('birthdays')}}" class="nav-link {{$birthday_menu}}">
                            <i class="nav-icon fa fa-birthday-cake"></i>
                            <p>
                                 Birthdays
                            </p>
                        </a>
                    </li>





                    <li class="nav-item">
                        <a href="{{route('meetings.index')}}" class="nav-link {{$meet_menu}}">
                            <i class="nav-icon fa fa-tv"></i>
                            <p>
                                Live Programmes
                            </p>
                        </a>
                    </li>



                    <li class="nav-item">
                        <a href="{{route('courses.index')}}" class="nav-link {{$training_menu}}">
                            <i class="nav-icon fa fa-graduation-cap"></i>
                            <p>
                               Trainings
                            </p>
                        </a>
                    </li>



                    <li class="nav-item">
                        <a href="{{route('resources.index')}}" class="nav-link {{$resource_menu}}">
                            <i class="nav-icon fa fa-newspaper"></i>
                            <p>
                                Posts
                            </p>
                        </a>
                    </li>



                    <li class="nav-item">
                        <a href="{{route('slides.index')}}" class="nav-link {{$slides_menu}}">
                            <i class="nav-icon fa fa-image"></i>
                            <p>
                                Slides
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('campus.index')}}" class="nav-link {{$campus_menu}}">
                            <i class="nav-icon fa fa-globe"></i>
                            <p>
                                Campus Zones
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('zone.index')}}" class="nav-link {{$zone_menu}}">
                            <i class="nav-icon fa fa-globe"></i>
                            <p>
                                Church Zones
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('magazines.index')}}" class="nav-link {{$magazine_menu}}">
                            <i class="nav-icon fa fa-file-pdf"></i>
                            <p>
                                Magazines
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('adminNotification')}}" class="nav-link {{$notif_menu}}">
                            <i class="nav-icon fa fa-signal"></i>
                            <p>
                                Push Notification
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{route('logout')}}" class="nav-link ">
                            <i class="nav-icon fa fa-power-off"></i>
                            <p>
                               Log Out
                            </p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{$page_title}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><i class="fa fa-home"></i></li>
                            <li class="breadcrumb-item active">{{$page_title}}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        @if(session('message'))
                            <div class="alert alert-info dismissAlert">{{session('message')}}</div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger dismissAlert">{{session('error')}}</div>
                        @endif
                    </div>
                </div>
                @yield('content')
            </div>

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
            <b>Version</b> 1.0.0
        </div>
        <strong>Copyright &copy; {{date('Y')}} <a href="https://thewatchersnwtwork.org">WATCHERS NETWORK</a>.</strong> All rights reserved.
    </footer>

</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- Bootstrap 4 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.1/js/bootstrap.bundle.min.js" integrity="sha512-mULnawDVcCnsk9a4aG1QLZZ6rcce/jSzEGqUkeOLy0b6q0+T6syHrxlsAGH7ZVoqC93Pd0lBqd6WguPWih7VHA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- AdminLTE App -->
<script src="{{url('admin_assets/js/adminlte.min.js')}}"></script>

<script>
    let dismissAlert = $('.dismissAlert');
    if(dismissAlert){
        setTimeout(function(){
            dismissAlert.hide(500);
        }, 3000);
    }
</script>

@yield('script')
</body>
</html>
