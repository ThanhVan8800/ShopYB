<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\Menu\CreateFormRequest;
use Illuminate\Http\Request;
use App\Http\Services\Menu\MenuService;
use Illuminate\Http\JsonResponse;
use App\Models\Menu;

class MenuController extends Controller
{
    protected $menuService;
    public function __construct(MenuService $menuService)
    //Hàm __construct(), cho phép người dùng khởi tạo các thuộc tính của một đối tượng khi tạo đối tượng.
    {
        $this->menuService = $menuService;
    }
    public function create()
    {
        return view('admin.menu.add',
            [
                'title'=>'Thêm danh mục mới',
                 'menus'=> $this->menuService->getParent()// mô hình 2 cấp id cha,con
            ]);
    }
    // hàm store kiểm tra người dùng có nhập không
    public function store(CreateFormRequest $request)
    {
        $result = $this->menuService->create($request);
        return redirect()->back();// chuyển hướng người dùng trở lại trang trước nếu tạo không thành công
        //dd($request->input());// tương tự var_dump, die()
        //tạo formrequest, php artisan make:request Menu\CreateFormRequest
    }
    public function index()
    {
        return view('admin.menu.list',
        [
            'title'=>'Danh sách danh mục mới nhất',
            'menus'=>$this->menuService->getAll()
        ]);
    }
    public function show(Menu $menu)
    {
        //dd($menu);
        return view('admin.menu.edit' , [
            'title' => 'Chỉnh sửa danh mục:' . $menu->name,
            'menu' => $menu,
            'menus'=> $this->menuService->getParent()
        ]);
    }
    public function update(Menu $menu, CreateFormRequest $request)
    {
        $this->menuService->update($request, $menu);

        return redirect('/admin/menus/list');
    }
    public function destroy(Request $request):JsonResponse
    {
        $result = $this->menuService->destroy($request);
        if($result){
            return response()->json([
                'error' => false,
                'message' => 'Xóa thành công'
            ]);
        }
        return response()->json([
            'error'=> true
        ]);
    }
}
