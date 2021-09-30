@extends('layouts.admin')
 
 @section('title')
<title>Trang chủ</title>

 @endsection

 @section('content')
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('partials.content_header',['name'=>'Menu','key'=>'List'])
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <a href="{{route('menus.create')}}" class="btn btn-success float-right m-2">Add</a>
          </div>
          <div class="col-md-12">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tên Menu</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
            @foreach($ListMenu as $item)
                  <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>{{$item -> name}}</td>
                    <td>
                      <a href="{{route('menus.edit',[$item -> id])}}" class="btn btn-default">Sửa</a>
                      <a href="{{route('menus.delete',[$item -> id])}}" class="btn btn-danger">Xóa</a>
                    </td>
                  </tr>
            @endforeach 
                </tbody>
              </table>
              <div class="col-md-12">
              {{$ListMenu -> links('pagination::bootstrap-4')}}
            </div>
          </div>
          <div class="col-md-12 text-center-right">
      
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @endsection