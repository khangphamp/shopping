@extends('layouts.admin')
 
 @section('title')
<title>Trang chủ</title>

 @endsection

 @section('content')
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    @include('partials.content_header',['name'=>'Category','key'=>'Add'])
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <form action="{{route('categories.store')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label>Tên Danh Mục</label>
                        <input  type="text" 
                                name="name"
                                class="form-control" 
                                placeholder="Nhập tên Danh mục">
                    </div>
                    <div class="form-group">
                        <label>Chọn danh mục cha</label>
                        <select class="form-control" name="parent_id">
                        <option value="0">Chọn danh mục cha</option>
                        {!!$htmlOption!!}

                        </select>
                    </div>
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