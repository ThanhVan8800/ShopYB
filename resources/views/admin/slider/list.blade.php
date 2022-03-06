@extends('admin.main')

@section('content')
        <table class="table">
            <thead>
                <tr>
                    <th style="width:50px">ID</th>
                    <th>Tiêu đề </th>
                    <th>Đường dẫn</th>
                    <th>Ảnh</th>
                    
                    <th>Active</th>
                    <th>Update</th>
                    <th style="width:100px">Change</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sliders as $key => $slider )
                
                    <tr>
                            <td>{{  $slider->id }}</td>
                            <td>{{  $slider->name }}</td>
                            <td>{{  $slider->url    }}</td>
                            <td>
                                <a href="{{$slider->thumb}} " target="_blank">
                                    <img src="{{$slider->thumb}}" height="50px" alt="">
                                </a>    
                            </td>
                            <td>{!!  \App\Helpers\Helper::active($slider->active)  !!}</td>  
                            <!-- đang chuỗi để !! chuyển qua html -->
                            <td>{{  $slider->updated_at  }}</td>
                            <td>
                                <a href="/admin/sliders/edit/{{$slider->id}}" class="btn btn-primary btn-sm" >
                                <i class="far fa-edit"></i>
                                </a>
                                <a href="#"  class="btn btn-danger btn-sm"
                                onclick="removeRow( {{ $slider -> id }} , '/admin/sliders/destroy' )" >
                                <i class="far fa-trash-alt"></i>
                                </a>
                            </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {!! $sliders->links() !!}

@endsection