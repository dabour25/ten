@extends('layouts.master')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Master Maker</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/myadmin/{{$secret}}">Home</a></li>
                        <li class="breadcrumb-item active">Master</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <form action="/myadmin/{{$secret}}/editmaster" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="icon">Icon / Logo of site</label>
                    <br>
                    <input type="file" id="icon" name="icon">
                    <br><br>
                    <img src="{{!empty($data[1]->value)?asset('/images/'.$data[1]->value):asset('/images/ten-logo.png')}}" width="50px">
                </div>
                <div class="form-group">
                    <label for="icon">Site name/Title</label>
                    <input name="title" class="form-control" placeholder="website title it will added to <title></title> tag as (title|{page})" value="{{$data[0]->value}}">
                </div>
                <div class="form-group">
                    <label for="icon">Head HTML Code</label>
                    <textarea name="head" class="form-control" rows="6" placeholder="Bootstrap, font awesome, jquery, ckeditor added auto.., insert only meta data and any fonts or css libraries">{{$data[2]->value}}</textarea>
                </div>
                <div class="form-group">
                    <label for="icon">Header HTML Code</label>
                    <textarea name="header" class="form-control" rows="6" placeholder="add header html, code will be inside <header></header> auto, insert menu and links, for logo add <img class='mylogo'>, for any data from DB use same Laravel/Blade codes">{{$data[3]->value}}</textarea>
                </div>
                <div class="form-group">
                    <label for="icon">Footer HTML Code</label>
                    <textarea name="footer" class="form-control" rows="6" placeholder="add Footer html, code will be inside <footer></footer> auto, insert menu and links, for logo add <img class='mylogo'>, for any data from DB use same Laravel/Blade codes">{{$data[4]->value}}</textarea>
                </div>
                <div class="form-group">
                    <label for="icon">scripts HTML tags</label>
                    <textarea name="scripts" class="form-control" rows="6" placeholder="add custom scripts or script sources, it will be after pody of any page">{{$data[5]->value}}</textarea>
                </div>
                <button type="submit" class="btn btn-success">Save</button>
                <br><br>
            </form>
        </div><!-- /.container-fluid -->
    </section>
@endsection
