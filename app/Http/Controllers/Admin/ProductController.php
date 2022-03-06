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
    public function show(Product $product)
    {
        return view('admin.product.edit',[
            'title' => 'Chỉnh sửa sản phẩm',
            'product' => $product,
            'menus' => $this->productService->getMenu()
        ]);

    }
    public function update(Request $request, Product $product)
    {
        $result =  $this->productService->update($request, $product);
        if($result){
            return redirect('/admin/products/list');
        }
        return redirect() -> back();
    }
    public function destroy(Request $request)
    {
        $result = $this->productService->delete($request);
        if($result)
        {
            return response()->json([
                'error' => false,
                'message' => 'Xóa thành công'
            ]);
        }
        return response()->json([
            'error' => true,
        ]);
    }
    public function search(Request $request)
    {
        $output = '';
        $product1 = Product::where('name', 'LIKE' , '%' . $request->keyword . '%')->get();

        foreach ($product1 as $product)
        {
            $output .= '<tr>
                            <td>'.  $product->id .'</td>
                            <td>'.  $product->name .'</td>
                            <td>'.  $product->menu->name .'</td>
                            <td>'.  $product->price    .'</td>
                            <td>'.  $product->price_sale  .'</td>
                            <!-- đang chuỗi để !! chuyển qua html -->
                            <td>'.  $product->updated_at  .'</td>
                            </tr>
            ';
        }
        return response()->json($output);
    }
}
