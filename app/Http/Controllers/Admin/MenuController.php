<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\Menu\CreateFormRequest;
use Illuminate\Http\Request;
use App\Http\Services\Menu\MenuService;


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
                'menus'=> $this->menuService->getParent()
            ]);
    }
    public function store(CreateFormRequest $request)
    {
        $result = $this->menuService->create($request);
        return redirect()->back();// chuyển hướng người dùng trở lại trang trước nếu tạo không thành công
        //dd($request->input());// tương tự var_dump, die()
        //tạo formrequest, php artisan make:request Menu\CreateFormRequest
    }
}
