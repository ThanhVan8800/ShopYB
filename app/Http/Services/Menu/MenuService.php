<?php
namespace App\Http\Services\Menu;
use Illuminate\Support\Str;
use App\Models\Menu;
use Illuminate\Support\Facades\Session;
class MenuService
{
    public function getParent()
    {
        return Menu::where('parent_id',0)->get();// tạo danh mục 2 cấp 
    }
    public function create($request)
    {
        try
        {
                Menu::create([
                    'name' => (string) $request->input('name'),
                    'parent_id' => (string) $request->input('parent_id'),
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
}