@extends('layouts.admin')
 
 @section('title')
<title>Add Product</title>

 @endsection
 @section('css')
 <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

 @endsection

 @section('content')
 <style>
.select2-container--default .select2-selection--multiple .select2-selection__choice{
   background-color:#000;
 }
 .select2-selection.select2-selection--single.select2-selection--clearable{
  height: 40px;
 }
 </style>
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    @include('partials.content_header',['name'=>'Product','key'=>'Add'])
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
          @if ($errors->any())
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
          @endif
          </div>
        <form action="{{route('products.store')}}" method="post" enctype="multipart/form-data">
        @csrf
               <div class="col-md-6">                                  
                    <div class="form-group">
                        <label>Tên san phẩm</label>
                        <input  type="text" 
                                name="name"
                                class="form-control @error('name') is-invalid @enderror" 
                                placeholder="Nhập tên sản phẩm"
                                value="{{old('name')}}"
                                >
                                
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                 @enderror
                    </div>
                    
                    <div class="form-group">
                        <label>Giá sản phẩm</label>
                        <input  type="text" 
                                name="price"
                                class="form-control"
                                value="{{old('price')}}" 
                                placeholder="Nhập giá sản phẩm">
                    </div>
                    <div class="form-group">
                        <label>Ảnh đại điện</label>
                        <input  type="file" 
                                name="feature_image_path"
                                value="{{old('feature_image_path')}}" 
                                multiple
                                class="form-control-file" >
                                
                    </div>
                    <div class="form-group">
                        <label>Ảnh chi tiết</label>
                        <input  type="file" 
                                name="image_path[]"
                                multiple
                                class="form-control-file" >
                                
                    </div>
                    <div class="form-group">
                        <label>Chọn Menu cha</label>
                        <select class="form-control select2_category" name="category_id">
                          <option value="">Chọn danh mục</option>
                        {!!$htmlOption!!}
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nhập tag cho sản phẩm</label>
                        <select name="tags[]" class="form-control tag_select_choose" multiple="multiple">
                         
                        </select>
                    </div>              
            </div>
            <div class="col-md-12">
                     <div style="min-width:1200px" class="form-group">
                      <label>Nội dung</label>
                      <textarea name="content" class="form-control content_editor"rows="3"></textarea>
                    </div>
            </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
            </form>       
          </div>
  
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
$(document).ready(function(){
  $(".tag_select_choose").select2({
    tags: true,
    tokenSeparators: [',']
  })
  $(".select2_category").select2({
    placeholder: "Chọn Danh muc",
    allowClear: true
  })
// adasdsadasdadas
var editor_config = {
    path_absolute : "/",
    selector: 'textarea.content_editor',
    relative_urls: false,
    plugins: [
      "advlist autolink lists link image charmap print preview hr anchor pagebreak",
      "searchreplace wordcount visualblocks visualchars code fullscreen",
      "insertdatetime media nonbreaking save table directionality",
      "emoticons template paste textpattern"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
    file_picker_callback : function(callback, value, meta) {
      var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
      var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

      var cmsURL = editor_config.path_absolute + 'filemanager?editor=' + meta.fieldname;
      if (meta.filetype == 'image') {
        cmsURL = cmsURL + "&type=Images";
      } else {
        cmsURL = cmsURL + "&type=Files";
      }

      tinyMCE.activeEditor.windowManager.openUrl({
        url : cmsURL,
        title : 'Filemanager',
        width : x * 0.8,
        height : y * 0.8,
        resizable : "yes",
        close_previous : "no",
        onMessage: (api, message) => {
          callback(message.content);
        }
      });
    }
  };

  tinymce.init(editor_config);
  
})




</script>

@endsection