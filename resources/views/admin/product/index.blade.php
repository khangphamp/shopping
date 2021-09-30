@extends('layouts.admin')
 
 @section('title')
<title>Trang chủ</title>

 @endsection

 @section('content')
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('partials.content_header',['name'=>'Product','key'=>'List'])
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <a href="{{route('products.create')}}" class="btn btn-success float-right m-2">Add</a>
          </div>
          <div class="col-md-12">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tên Sản phẩm</th>
                    <th scope="col">Giá</th>
                    <th scope="col">Hình ảnh</th>
                    <th scope="col">Danh mục</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
           @foreach($Listproduct as $product)
                  <tr>
                    <th scope="row">{{$loop->index+1}}</th>
                    <td>{{$product->name}}</td>
                    <td>{{ number_format($product->price) }}</td>
                    <td>
                        <img style="width:200px;height:170px;" src="{{$product->feature_image_path}}"/>
                    </td>
                    <td>{{optional($product->categories)->name}}</td>
                    <td>
                      <a href="{{route('products.edit',[$product->id])}}" class="btn btn-default">Sửa</a>
                      <a href="{{route('products.delete',[$product->id])}}" class="btn btn-danger">Xóa</a>
                    </td>
                  </tr>
            @endforeach
                </tbody>
              </table>
              <div class="col-md-12">
                {{$Listproduct -> links('pagination::bootstrap-4')}}
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