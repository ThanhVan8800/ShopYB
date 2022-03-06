<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\Slider\SliderAdminService;
use App\Http\Services\Menu\MenuService;


class MainController extends Controller
{
    // protected $slider;
    // public function __construct(SliderAdminService $slider)
    // {
    //     $this->slider = $slider;
    // }
    public function index()
    {
        return view('admin.home',[
            'title' => 'Trang quản trị',
            // 'sliders' => $this->slider -> show()
        ]);
    }
}
