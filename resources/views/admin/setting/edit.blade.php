@extends('layouts.admin')
 
 @section('title')
<title>Setting</title>

 @endsection

 @section('content')
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    @include('partials.content_header',['name'=>'Setting','key'=>'Edit'])
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <form action="{{route('settings.update',[$setting->id])}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label>Config Key</label>
                        <input  type="text" 
                                name="config_key"
                                value="{{$setting->config_key}}"
                                class="form-control" 
                                placeholder="Nhập config key">
                    </div>
                @if($setting->type === 'Text')
                    <div class="form-group">
                        <label>Config value</label>
                        <input  type="text" 
                                value="{{$setting->config_value}}"
                                name="config_value"
                                class="form-control" 
                                placeholder="Nhập config values">
                    </div>
                @elseif($setting->type === 'Textarea')
                    <div class="form-group">
                        <label>Config value</label>
                        <textarea
                                name="config_value"
                                class="form-control" 
                                rows="5"
                        >
                        {{$setting->config_value}}
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