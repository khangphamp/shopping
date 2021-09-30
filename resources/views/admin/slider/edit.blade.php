@extends('layouts.admin')
 
 @section('title')
<title>Slider</title>

 @endsection

 @section('content')
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    @include('partials.content_header',['name'=>'Slider','key'=>'Edit'])
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <form action="{{route('sliders.update',[$slider->id])}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Tên Slider</label>
                        <input  type="text" 
                                name="name"
                                class="form-control" 
                                value="{{$slider->name}}"
                                placeholder="Nhập tên Slide">
                    </div>
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label>Hình ảnh</label>
                        <input  type="file" 
                                name="image_path"
                                class="form-control-file" >
                                
                    </div>
                    <div class="col-md-6">
                    <img style="width:400px;height: 200px;" src="{{$slider ->image_path}}"/>
                    </div>
                  
                    @error('image_path')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>           
            </div>
          </div>
  
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @endsection