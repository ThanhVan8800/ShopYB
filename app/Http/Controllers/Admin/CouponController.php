<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;
use Session;
session_start();
use Illuminate\Support\Facades\Redirect;
use App\Http\Services\Coupon\CouponService;

class CouponController extends Controller
{
    protected $coupon ;
    public function __construct(CouponService $coupons)
    {
        $this->coupon = $coupons;
    }
    public function create(Request $request)
    {
        return view('admin.coupon.add',[
            'title' => 'Thêm mã giảm giá'
        ]);
    }
    public function store(Request $request)
    {
        $this->validate($request,[
            'coupon_name' => 'required',
            'coupon_code' => 'required',
            'coupon_time' => 'required',
            'coupon_number' => 'required',
        ]);
        $this->coupon->insert($request);
        return redirect()->back();
    }
    public function index() 
    {
        return view('admin.coupon.list',[
            'title' => 'Danh sách Mã Giảm Giá',
            'coupons' =>$this->coupon->get()
        ]);
    }
    public function show(Coupon $coupon) 
    {
        return view('admin.coupon.edit',[
            'title' => 'Chỉnh sửa Coupon',
            'coupon' => $coupon
        ]);
    }
    public function update(Request $request, Coupon $coupon)
    {
        $this->validate($request,[
            'coupon_name' => 'required',
            'coupon_code' => 'required',
            'coupon_time' => 'required',
            'coupon_number' => 'required',
        ],[
            'coupon_name.required' => 'Tên không được để trống',
        ]);
        $result = $this->coupon->update($request,$coupon);
        if($result)
        {
            return redirect('admin/coupons/list');
        }
        return redirect()->back();
    }
    public function destroy(Request $request)
    {
            $result = $this->coupon->destroy($request);
            if($result)
            {
                return response()->json([
                    'error' => false,
                    'message' => 'Xóa thành công'
                ]);
            }
            return response()->json([
                'error' => true,
                'message' => 'Xóa không được'
            ]);
    }
    public function delete($coupon_id)
    {
        $coupon = Coupon::find($coupon_id);
        $coupon->delete();
        Session::put('message','Xoa ma giam gia thanh cong');
        return redirect()->back();
    }

}
