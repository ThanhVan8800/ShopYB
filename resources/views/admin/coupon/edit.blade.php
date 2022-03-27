@extends('admin.main')


@section('content')
<form action="" method="POST">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="menu">Tên mã giảm giá</label>
                        <input type="text" name="coupon_name" value="{{ $coupon->coupon_name }}" class="form-control"  placeholder="Nhập tên sản phẩm">
                    </div>
                    <div class="form-group">
                        <label for="menu">Mã code</label>
                        <input type="text" name="coupon_code" value="{{ $coupon->coupon_code }}" class="form-control"  placeholder="Nhập tên sản phẩm">
                    </div>
                    <div class="form-group">
                        <label for="menu">Thời hạn</label>
                        <input type="text" name="coupon_time" value="{{ $coupon->coupon_time }}" class="form-control"  placeholder="Nhập tên sản phẩm">
                    </div>
                    <div class="form-group">
                        <label for="menu">Số lượng</label>
                        <input type="text" name="coupon_number" value="{{ $coupon->coupon_number }}" class="form-control"  placeholder="Nhập tên sản phẩm">
                    </div>
                    
                    
                </div>
        </div>
            <div class="form-group">
                <label>Kích Hoạt</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="1" type="radio" id="active" name="coupon_condition"
                    checked="{{$coupon->coupon_condition == 1 ? 'checked' : ''}}">
                    <label for="active" class="custom-control-label">Có</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="0" type="radio" id="no_active" name="coupon_condition"
                    {{$coupon->coupon_condition == 0 ? 'checked' : ''}} >
                    <label for="no_active" class="custom-control-label">Không</label>
                </div>
            </div>

        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Cập nhật coupon</button>
        </div>
        @csrf
    </form>
@endsection
