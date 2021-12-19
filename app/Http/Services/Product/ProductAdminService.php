<?php


namespace App\Http\Services\Product;


use App\Models\Menu;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

class ProductAdminService
{
    public function getMenu()
    {
        return Menu::where('active', 1)->get();
    }
    protected function isValidPrice($request)
    {
        if($request->input('price')!=0 && $request->input('price_sale') != 0 && $request->input('price_sale')>= $request->input('price'))
        {
            Session::flash('error','Giá giảm phải nhỏ hơn giá gốc');
            return false;
        }
        if($request->input('price_sale') !=0 && (int)$request->input('price')==0)
        {
            Session::flash('error','Vui lòng nhập giá gốc');
            return false;
        }
        return true;
    }
    public function insert($request)
    {
            $isValidPrice = $this->isValidPrice($request);
            if($isValidPrice == false)  return false;
            //dd($request->all());
        try{
            $request->except('_token'); // không cần lấy token vào database nên bỏ ra
            Product::create($request->all());
            Session::flash('success', 'Thêm thành công');
        }catch(\Exception $err)
        {
            Session::flash('error','Thêm sản phẩm bị lỗi');
            // \Log::info($err->getMessage());
            return false;
        }
        return true;
    }
    public function get()
    {
        return Product::with('menu')->orderByDesc('id')->paginate(15);// menu kết bản sp vs menu
    }
}