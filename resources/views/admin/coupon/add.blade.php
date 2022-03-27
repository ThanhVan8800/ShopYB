@extends('admin.main')

@section('head')
    <script src="/ckeditor/ckeditor.js"></script>
@endsection

@section('content')
        <?php 
            $message = Session::get('message');
            if($message){
                echo '<span class="text-alert">' .$message . '</span>';
                Session::put('message', null);
            }
        ?>
<form action="" method="POST">
            @csrf
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="menu">Tên Mã giảm giá</label>
                        <input type="text" name="coupon_name" value="{{ old('name') }}" class="form-control"  placeholder="Nhập tên sản phẩm">
                    </div>
                    <div class="form-group">
                        <label for="menu"> Mã giảm giá</label>
                        <input type="text" name="coupon_code" value="{{ old('name') }}" class="form-control"  placeholder="Nhập tên sản phẩm">
                    </div>
                    <div class="form-group">
                        <label for="menu">Số lượng mã</label>
                        <input type="text" name="coupon_time" value="{{ old('name') }}" class="form-control"  placeholder="Nhập tên sản phẩm">
                    </div>
                    <div class="form-group">
                        <label for="menu">Tính năng mã</label>
                        <select name="coupon_condition" id="">
                            <option value="0">---Chọn---</option>
                            <option value="1">Giảm theo phần trăm</option>
                            <option value="2">Giảm theo tiền</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="menu">Nhập số % hoặc tiền giảm</label>
                        <input type="text" name="coupon_number" value="{{ old('name') }}" class="form-control"  placeholder="Nhập tên sản phẩm">
                    </div>
                </div>

                
            </div>
            

        </div>

        <div class="card-footer">
            <button type="submit" name="" class="btn btn-primary">Thêm Mã Giảm Giá</button>
        </div>
    </form>
@endsection

@section('footer')
    <script>
        CKEDITOR.replace('content');
    </script>
@endsection