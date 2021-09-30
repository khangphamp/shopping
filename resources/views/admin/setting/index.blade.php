@extends('layouts.admin')
 
 @section('title')
<title>Setting</title>

 @endsection

 @section('content')
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('partials.content_header',['name'=>'Setting','key'=>'List'])
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
          <div class="dropdown show float-right">
              <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               Add Setting
              </button>
              <div class="dropdown-menu">
                <a href="{{route('settings.create').'?type=Text'}}" class="dropdown-item" href="#">Text</a>
                <a href="{{route('settings.create').'?type=Textarea'}}" class="dropdown-item" href="#">Textarea</a>
              </div>
            </div>
          </div>
          <div class="col-md-12">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Config key</th>
                    <th scope="col">Config value</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
              @foreach($listsetting as $item)
                  <tr>
                    <th scope="row">{{$item->id}}</th>
                    <td>{{$item->config_key}}</td>
                    <td>{{$item->config_value}}</td>
                    <td>
                      <a href="{{route('settings.edit',[$item->id])}}" class="btn btn-default">Sửa</a>
                      <a href="{{route('settings.delete',[$item->id])}}" class="btn btn-danger">Xóa</a>
                    </td>
                  </tr>
                @endforeach
                </tbody>
              </table>
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