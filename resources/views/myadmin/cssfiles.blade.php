@extends('layouts.master')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">CSS Files Page</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/myadmin/{{$secret}}">Home</a></li>
                        <li class="breadcrumb-item active">cssfiles</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
        <div class="container-fluid">
            <form action="/myadmin/{{$secret}}/add-css" method="POST" enctype="multipart/form-data">
                @csrf
                Insert CSS File: <input type="file" name="cssfile">
                <button class="btn btn-success" type="submit">Insert</button>
            </form>
            <hr>
            <table class="table table-dark">
                <thead>
                    <th>#</th>
                    <th>File Name</th>
                    <th>Full Path</th>
                    <th>Tools</th>
                </thead>
                <tbody>
                    @foreach($cssfiles as $k=>$cssfile)
                    <tr>
                        <td>{{$k+1}}</td>
                        <td>{{$cssfile->file_name}}</td>
                        <td>{{$cssfile->full_html}}</td>
                        <td>
                            <a href="{{asset($cssfile->full_html)}}" class="btn btn-info" download><i class="fas fa-download"></i></a>
                            <button class="btn btn-danger"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div><!-- /.container-fluid -->
    </section>
@endsection
