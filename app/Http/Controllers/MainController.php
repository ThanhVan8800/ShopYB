<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\Slider\SliderAdminService;
use App\Http\Services\Menu\MenuService;
use App\Http\Services\Product\ProductService;

class MainController extends Controller
{
    protected $slider;
    protected $menu;
    protected $product;

    public function __construct(SliderAdminService $slider, MenuService $menu, ProductService $product)
    {
        $this -> slider = $slider;
        $this-> menu = $menu;
        $this->product = $product;
    }
    public function index()
    {
    
        return view('home',[
            'title' => 'Shop Quần Áo',
            'sliders' => $this->slider->show(),
            'menus' => $this->menu->show(),
            'products' => $this->product->get()
        ]);
    }
    public function loadProduct(Request $request)
    {
        $page = $request->input('page',0);

        $result = $this->product->get($page);
            // count kiểm tra nếu != 0 thì còn item 
        if(count($result)!= 0){
            $html = view('product.list',[
                'products' => $result
            ])->render();
        }
        return response()->json([
            'html' => ''
        ]);
    }
}
