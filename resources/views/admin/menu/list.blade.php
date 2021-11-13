@extends('admin.main')

@section('content')
        <table class="table">
            <thead>
                <tr>
                    <th style="width:50px">ID</th>
                    <th>Name</th>
                    <th>Active</th>
                    <th>Update</th>
                    <th style="width:100px">Change</th>
                </tr>
            </thead>
            <tbody>
                <!-- đệ quy, tạo helper, có thể viết trực tiếp chỗ này -->
                 {!! \App\Helpers\Helper::menu($menus) !!}
                <!-- đọc được html, biên dịch dc html, $menus dc truyền từ controller -->
            </tbody>
        </table>

@endsection