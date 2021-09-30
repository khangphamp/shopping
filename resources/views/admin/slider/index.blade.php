@extends('layouts.admin')
 
 @section('title')
<title>Slider</title>

 @endsection

 @section('content')
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('partials.content_header',['name'=>'Slider','key'=>'List'])
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <a href="{{route('sliders.create')}}" class="btn btn-success float-right m-2">Add</a>
          </div>
          <div class="col-md-12">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tên Slider</th>
                    <th scope="col">Hình ảnh</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
             @foreach($sliderList as $item )     
                  <tr>
                    <th scope="row"></th>
                    <td>{{$item -> name}}</td>
                    <td>
                        <img style="width:400px;height: 200px;" src="{{$item ->image_path}}"/>
                    </td>
                    <td>
                      <a href="{{route('sliders.edit',[$item -> id])}}" class="btn btn-default">Sửa</a>
                      <a href="{{route('sliders.delete',[$item -> id])}}" class="btn btn-danger">Xóa</a>
                    </td>
                  </tr>
              @endforeach  
                </tbody>
              </table>
          </div>
          <div class="col-md-12 text-center-right">
           {{$sliderList ->links('pagination::bootstrap-4')}}
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @endsection