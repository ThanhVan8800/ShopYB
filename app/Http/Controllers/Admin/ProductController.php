<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductRequest;
use App\Http\Services\Product\ProductAdminService;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
   
    protected $productService;
    public function __construct(ProductAdminService $productService){
        $this->productService = $productService;
    }
    public function index()
    {
        return view('admin.product.list',[
            'title'=>'Danh sách sản phẩm',
            'products' => $this->productService->get()
        ]);
    }
    public function create()
    {
        return view('admin.product.add',[
            'title'=>'Thêm Sản Phẩm Mới',
            'menus' => $this->productService->getMenu()
        ]);
        //
    }
    public function store(ProductRequest $request)
    {
        $this->productService->insert($request);
        return redirect()->back();
    }

}
