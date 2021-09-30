@extends('layouts.admin')
 
 @section('title')
<title>Trang chủ</title>

 @endsection

 @section('content')
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('partials.content_header',['name'=>'Category','key'=>'List'])
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <a href="{{route('categories.create')}}" class="btn btn-success float-right m-2">Add</a>
          </div>
          <div class="col-md-12">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tên danh mục</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($ListCategory as $ItemCategory)
                  <tr>
                    <th scope="row">{{$ItemCategory -> id}}</th>
                    <td>{{$ItemCategory -> name}}</td>
                    <td>
                      <a href="{{route('categories.edit',[$ItemCategory -> id])}}" class="btn btn-default">Sửa</a>
                      <a href="{{route('categories.delete',[$ItemCategory -> id])}}" class="btn btn-danger">Xóa</a>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
          </div>
          <div class="col-md-12 text-center-right">
            {{$ListCategory-> links('pagination::bootstrap-4')}}
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @endsection