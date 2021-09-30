@extends('layouts.admin')
 
 @section('title')
<title>Trang chủ</title>

 @endsection

 @section('content')
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    @include('partials.content_header',['name'=>'Menu','key'=>'Add'])
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <form action="{{route('menus.store')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label>Tên Menu</label>
                        <input  type="text" 
                                name="name"
                                class="form-control" 
                                placeholder="Nhập tên Menu">
                    </div>
                    <div class="form-group">
                        <label>Chọn Menu cha</label>
                        <select class="form-control" name="parent_id">
                        <option value="0">Chọn Menu cha</option>
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