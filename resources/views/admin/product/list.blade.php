@extends('admin.main')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
@section('content')

<label for="keyword">Tìm kiếm</label>
        <div class="form-group">
            <input type="text " name="keyword" id="keyword" class="form-control">
        </div>
        <table class="table" >
            <thead>
                <tr>
                    <th style="width:50px">ID</th>
                    <th>Tên sản phẩm</th>
                    <th>Danh mục</th>
                    <th>Giá gốc</th>
                    <th>Giá khuyến mãi</th>
                    <th>Active</th>
                    <th>Update</th>
                    <th style="width:100px">Change</th>
                </tr>
            </thead>
            <tbody id="lsdiadanh">
                @foreach($products as $key => $product )
                
                    <tr>
                            <td>{{  $product->id }}</td>
                            <td>{{  $product->name }}</td>
                            <td>{{  $product->menu->name }}</td>
                            <td>{{  $product->price    }}</td>
                            <td>{{  $product->price_sale   }}</td>
                            <td>{!!  \App\Helpers\Helper::active($product->active)  !!}</td>  
                            <!-- đang chuỗi để !! chuyển qua html -->
                            <td>{{  $product->updated_at  }}</td>
                            <td>
                                <a href="/admin/products/edit/{{$product->id}}" class="btn btn-primary btn-sm" >
                                <i class="far fa-edit"></i>
                                </a>
                                <a href="#"  class="btn btn-danger btn-sm"
                                    onclick="removeRow( {{ $product -> id }} , '/admin/products/destroy' )" >
                                    <i class="far fa-trash-alt"></i>
                                </a>
                            </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <!-- cho nó phân trang lại -->
        {!! $products->links() !!}
     
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
            $(document).ready(function(){
            $(document).on('keyup', '#keyword', function(){
                var keyword = $(this).val();

            $.ajax  ({
                type : "get",
                url : "/search",
                data : {
                        keyword : keyword},
                        dataType : "json",
                        success: function(response){
                            $('#lsdiadanh').html(response);
                        }
                })
            })
        })
    </script>   
@endsection
