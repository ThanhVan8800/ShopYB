@extends('admin.main')
@section('content')

<label for="keyword">Tìm kiếm</label>
        <div class="form-group">
            <input type="text " name="keyword" id="keyword" class="form-control">
        </div>
        <table class="table" >
            <thead>
                <tr>
                    <th style="width:50px">ID</th>
                    <th>Tên khách hàng</th>
                    <th>Số điện thoại</th>
                    <th>Địa chỉ</th>
                    <th>Email</th>
                    <th>Ngày đặt hàng</th>
                    <th>Ghi chú</th>
                    <th style="width:100px">Change</th>
                </tr>
            </thead>
            <tbody id="lsdiadanh">
                @foreach($customers as $key => $product )
                
                    <tr>
                            <td>{{  $product->id }}</td>
                            <td>{{  $product->name }}</td>
                            <td>{{  $product->phone }}</td>
                            <td>{{  $product->address }}</td>
                            <td>{{  $product->email   }}</td>
                            <td>{{  $product->created_at }}</td>
                            <!-- <td>{!!  \App\Helpers\Helper::active($product->active)  !!}</td>   -->
                            <!-- đang chuỗi để !! chuyển qua html -->
                            <td>{{  $product->content }}</td>  
                            <td>
                                <a href="/admin/customers/view/{{$product->id}}" class="btn btn-primary btn-sm" >
                                <i class="far fa-eye"></i>
                                </a>
                                <a href="#"  class="btn btn-danger btn-sm"
                                    onclick="removeRow( {{ $product -> id }} , '/admin/customers/destroy' )" >
                                    <i class="far fa-trash-alt"></i>
                                </a>
                            </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <!-- cho nó phân trang lại -->
        {!! $customers->links() !!}  
@endsection
