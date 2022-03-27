@extends('admin.main')

@section('content')
        <?php 
            $message = Session::get('message');
            if($message){
                echo '<span class="text-alert">' .$message . '</span>';
                Session::put('message', null);
            }
        ?>
        <table class="table">
            <thead>
                <tr>
                    <th style="width:50px">ID</th>
                    <th>Tên mã giảm giá </th>
                    <th>Mã code</th>
                    <th>Thời gian</th>
                    <th>Số lượng</th>
                    <th>Tính % hoặc tiền</th>
                    <th style="width:100px">Change</th>
                </tr>
            </thead>
            <tbody>
                @foreach($coupons as $key => $coupon )
                
                    <tr>
                            <td>{{  $coupon->coupon_id }}</td>
                            <td>{{  $coupon->coupon_name }}</td>
                            <td>{{  $coupon->coupon_code    }}</td>
                            <td>{{  $coupon->coupon_time    }}</td>
                            <td>
                                @if($coupon->coupon_condition == 1)
                                    {{ $coupon->coupon_number }} 
                                @else 
                                    {{ $coupon->coupon_number}} 
                                @endif
                            </td>
                            <td>
                                @if($coupon->coupon_condition == 1)
                                    Giam theo tien
                                @else 
                                    Giam theo %
                                @endif
                            </td>
                            <td>{!!  \App\Helpers\Helper::active($coupon->coupon_condition)  !!}</td>  
                            <!-- đang chuỗi để !! chuyển qua html -->
                            <td>{{  $coupon->updated_at  }}</td>
                            <td>
                                <a href="/admin/coupons/edit/{{$coupon->coupon_id}}" class="btn btn-primary btn-sm" >
                                <i class="far fa-edit"></i>
                                </a>
                                <a href="#"  class="btn btn-danger btn-sm"
                                onclick="removeRow( {{ $coupon -> coupon_id }} , '/admin/coupons/destroy' )" >
                                <i class="far fa-trash-alt"></i>
                                </a>
                                <a onclick="return confirm('Ban co chac xoa ?')" class="btn btn-danger btn-sm"
                                        href="{{URL::to('/admin/coupons/delete/'.$coupon->coupon_id)}}">
                                <i class="far fa-trash-alt"></i>

                                </a>
                            </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {!! $coupons->links() !!}

@endsection