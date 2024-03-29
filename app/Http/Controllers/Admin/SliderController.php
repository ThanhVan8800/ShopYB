<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Http\Services\Slider\SliderAdminService;
class SliderController extends Controller
{
    protected $slider;
        public function __construct(SliderAdminService $slider)
        {
            $this->slider = $slider;
        }
        public function create()
        {
            return view('admin.slider.add',[
                'title' => 'Thêm slider'
            ]);
        }
        public function store(Request $request)
        {
            $this->validate($request,[
                'name' => 'required',
                'url' => 'required',
                'thumb' => 'required'
            ]);
            $this->slider->insert($request);
            return Redirect()->back();
        }
        public function index()
        {
            return view('admin.slider.list',[
                'title' => 'Danh sách Slider mới nhất',
                'sliders' => $this->slider->get()
            ]);
        }
        public function show(Slider $slider)
        {
            return view('admin.slider.edit',[
                'title' => 'Chỉnh sửa Slide',
                'slider' => $slider
            ]);
        }
        public function update(Request $request, Slider $slider)
        {
            $this->validate($request,[
                'name' => 'required',
                'url' => 'required',
                'thumb' => 'required',
            ]);
                $result = $this->slider->update($request, $slider);
                if($result)
                {
                        return redirect('admin/sliders/list');
                }
                return redirect() -> back();
        }
        public function destroy(Request $request)
        {
            $result = $this->slider->destroy($request);
            if($result)
            {
                return response()->json([
                    'error' => false,
                    'message' => 'Xóa thành công'
                ]);
            }
            return response()->json(['error' => true]);
        }
}
