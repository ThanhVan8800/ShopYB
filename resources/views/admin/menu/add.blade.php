@extends('admin.main')
<!-- kế thừa source admin -->
 @section('head')
 <script src="/ckeditor/ckeditor.js"></script>

@endsection 
@section('content')

        <form action="" method="POST">
                <div class="card-body">
                  <div class="form-group">
                    <label for="menu">Tên Danh mục</label>
                    <input type="text" name="name" class="form-control"  placeholder="Nhập danh mục">
                  </div>

                  <div class="form-group">
                    <label >Danh mục</label>
                    <select name="parent_id" id="" class="form-control " >
                        <option value="0">Xe 4 bánh</option>
                        <option value="2">Xe 6 bánh</option>
                    </select>
                  </div>
                <div class="form-group">
                    <label >Mô tả</label>
                    <textarea name="description" id=""  class="form-control ">
                    </textarea>
                </div>
                <div class="form-group">
                    <label >Nội dung</label>
                    <textarea name="content" id="content" class="form-control ">
                    </textarea>
                </div>
                <!-- cột action-->
                <div class="form-group">
                    <label for="">Kích hoạt</label>
                        <div class="custom-control custom-radio">
                          <input class="custom-control-input" value="1" type="radio" id="active" name="active" checked="">
                          <label for="active" class="custom-control-label">có</label>
                        </div>
                        <div class="custom-control custom-radio">
                          <input class="custom-control-input" value="0" type="radio" id="no_active" name="active" >
                          <label for="no_active" class="custom-control-label">Không</label>
                        </div>
                      </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Tạo danh mục</button>
                </div>
                @csrf
         </form>
@endsection
@section('footer')
            <script>
                // Replace the <textarea id="editor1"> with a CKEditor 4
                // instance, using default configuration.
                CKEDITOR.replace( 'content' );
            </script>

@endsection