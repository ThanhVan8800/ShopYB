<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\Product\ProductService;
use App\Models\Product;
class ProductController extends Controller
{
    protected $productService;
    //phương thức khởi tạo

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }
    public function index($id = '', $slug = '')
    {
            $product = $this->productService->show($id);
            // product cho phần sản phẩm liên quan
            $productsMore = $this->productService->more($id);
            return view('product.content',[
                    'title' => $product->name,
                    'product' => $product,
                    'products' => $productsMore
            ]);
    }
    public function ajaxSearch()
    {
        $products = Product::search()->get();
        // $result = [
        //     'status' => true,
        //     'message' => 'Tim duoc  ' . $data->count(). '  ket qua',
        //     'data' => $data
        // ];
        return view('product.list', compact('products')); 
    }
    public function searchProduct(Request $request)
    {
        $keywords = $request->keywords_submit;
        $search_product = Product::where('active', 1 )->where('name','LIKE','%'.$keywords.'%')->get();
        // $data = $request->all();
        // if($data['query']){
        //     $product = Product::where('active', 1 )->where('name','LIKE','%'.$data['query'].'%')->get();
        //     $output = '<ul class="dropdown-menu " style="display:block; position:relative">';
        //     foreach($product as $key => $value){
        //         $output .='
        //                 <li> <a href="#">' .$value->name.'</a></li>
        //         ';
        //     }
        //     $output .='</ul>';
        //     echo $output;
        // }
        return view('product.search_product',['title'=>'Tìm kiếm'])->with('search_product',$search_product);
    }
}
