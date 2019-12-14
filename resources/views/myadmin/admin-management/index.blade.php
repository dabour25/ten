@extends('layouts.master')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Admin Management</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/myadmin/{{$secret}}">Home</a></li>
                        <li class="breadcrumb-item active">Admin Management</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <a href="/myadmin/{{$secret}}/admin-management/create" class="btn btn-primary">Create New Admin</a>
            <br><br>
            <table class="table table-dark">
                <thead>
                    <th>#</th>
                    <th>Email</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    @foreach($admins as $k=>$a)
                        <tr>
                            <td>{{$k+1}}</td>
                            <td>{{$a->email}}</td>
                            <td>
                                <a href="/myadmin/{{$secret}}/admin-management/{{$a->id}}/edit"><i class="fas fa-pen"></i></a>
                                <span style="padding-left: 20px;"></span>
                                <a href="#" onclick="deletefunction({{$a->id}});"><i class="fas fa-trash" style="color: red;"></i></a>
                            </td>
                        </tr>
                        <form action="/myadmin/{{$secret}}/admin-management/{{$a->id}}" method="post" id="delform{{$a->id}}" hidden>
                            @csrf
                            {{ method_field('delete') }}
                            <input type="hidden" value="{{$a->id}}" name="id">
                        </form>
                    @endforeach
                </tbody>
            </table>
        </div><!-- /.container-fluid -->
    </section>
    <script>
         function deletefunction(id){
            $('#delform'+id).submit();
         }
    </script>
@endsection
