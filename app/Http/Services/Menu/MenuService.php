<?php
namespace App\Http\Services\Menu;
use Illuminate\Support\Str;
use App\Models\Menu;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

class MenuService
{
    public function getParent()
    {
        return Menu::where('parent_id',0)->get();// tạo danh mục 2 cấp 
        // 0 là lấy danh mục cha, 1 lấy tất cả
    }
    public function show()
    {
        return Menu::select('id', 'name')
        -> where('parent_id',0)
        ->orderbyDesc('id')
        ->get();
    }
    public function getAll()
    {
            return Menu::orderbyDesc('id')->paginate(20);// phân trang và sắp xếp theo thứ tự
    }
    public function create($request)
    {
        try
        {
                Menu::create([
                    'name' => (string) $request->input('name'),
                    'parent_id' => (int) $request->input('parent_id'),
                    'description' => (string) $request->input('description'),
                    'content' => (string) $request->input('content'),
                    'active' => (string) $request->input('active'),
                    // 'slug' => Str::slug($request->input('name'),'-'),
                ]);

                // Tạo cái thông báo là đã tạo thành công
                Session::flash('success','Tạo thành công');
        } catch(\Exception $err)
        {
                Session::flash('error',$err->getMessage());
                return false;

        }
        return true;
    }
    public function update($request, $menu) : bool
    {
        try{
            if($request->input('parent_id') != $menu->id)
            {

                $menu->parent_id = (int) $request->input('parent_id');
            }
                $menu->name = (string) $request->input('name');
                $menu->description = (string) $request->input('description');
                $menu->content = (string) $request->input('content');
                $menu->active = (string) $request->input('active');
                $menu->save();
                Session::flash('success','Cập nhật thành công');
        } catch(\Exception $err)
        {
            Session::flash('error',$err->getMessage());
            return false;
        }
        return true;
    }
    public function destroy($request)
    {
        $id = (int) $request->input('id');
        $menu = Menu::where('id',$id)->first();

        if($menu){
            return Menu::where('id', $id)->orWhere('parent_id',$id)->delete();
        }
        return false;
    }
    public function getId($id)
    {
            return Menu::where('id', $id)->where('active',1)->firstOrfail();
    }
    public function getProducts($menu, $request)
    {
        // products từ hasmany model
        $query =  $menu->products()
        ->select('id',
                'name',
                'price',
                'price_sale',
                'active',
                'thumb'
            )
        ->where('active',1);
        // kiểm tra cái key $request->input('price') khi chạy key => value asc, desc
        if($request->input('price'))
        {
            $query  -> orderby('price',$request->input('price') );
        }
        return $query->orderbyDesc('id')->paginate(10)->withQueryString();
        // ->withQueryString(); để url page nối vs số trang
    }
}