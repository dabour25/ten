@extends('layouts.master')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Information Page</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/myadmin/{{$secret}}">Home</a></li>
                        <li class="breadcrumb-item active">Info</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><strong>System Requirements</strong></h5>
                            <p class="card-text">
                                <p><strong>PHP Version:</strong> 7.3.0</p>
                                <p><strong>Laravel Version:</strong> 6.5.1</p>
                                <p><strong>Processor:</strong> Intel core i5 4th Gen or higher</p>
                                <p><strong>RAM:</strong> 4GB</p>
                                <p><strong>Internet:</strong> >1 mbps</p>
                            </p>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><strong>Built-in Features</strong></h5>
                            <p class="card-text">
                                <p>Font Awesome 5.11.2</p>
                                <p>Admin LTE 3.0.0</p>
                                <p>CK-Editor 5</p>
                                <p>Bootstrap 4.3.1</p>
                                <p>JQuery 3.4.1</p>
                            </p>
                        </div>
                    </div>

                </div>
                <!-- /.col-md-6 -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><strong>System Data</strong></h5>
                            <p class="card-text">
                                <p><strong>TEN Version:</strong> 1.0</p>
                                <p><strong>Features:</strong> Smart Auth - Form Builder - Easy Template - Secure Roles</p>
                                <p><strong>Version release date:</strong> 2019??</p>
                            </p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><strong>Developer Data</strong></h5>
                            <p class="card-text">
                                This framework created by <b>Ahmed Magdy</b> Software Engineering - from Egypt
                                Full Stack Developer.
                                <br>
                                The idea comes to me when i was in training for job in one of companies, my Senior uses
                                form builder, i have an idea to develope his idea to full framework named TEN because my
                                birth day is 10/12/1996, i love also number ten, and start working on this framework at
                                10/12/2019 !!.
                            </p>
                        </div>
                    </div>
                </div>
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->


@endsection
