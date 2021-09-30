@extends('layouts.admin')
 
 @section('title')
<title>Setting</title>

 @endsection

 @section('content')
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    @include('partials.content_header',['name'=>'Setting','key'=>'Add'])
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <form action="{{route('settings.store').'?type='.request()->type}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label>Config Key</label>
                        <input  type="text" 
                                name="config_key"
                                class="form-control" 
                                placeholder="Nhập config key">
                    </div>
                @if(request()->type === 'Text')
                    <div class="form-group">
                        <label>Config value</label>
                        <input  type="text" 
                                name="config_value"
                                class="form-control" 
                                placeholder="Nhập config values">
                    </div>
                @elseif(request()->type === 'Textarea')
                    <div class="form-group">
                        <label>Config value</label>
                        <textarea
                                name="config_value"
                                class="form-control" 
                                rows="5"
                        >
                        </textarea>
                    </div>
                @endif
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