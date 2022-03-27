<?php
namespace App\Http\Services\Coupon;
use Illuminate\Support\Str;

use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Log;
use App\Models\Coupon;

class CouponService
{
    public function insert($request)
    {
        try
        {
            Coupon::create($request->input());
            Session()->flash('success','Thêm mã giảm giá thành công');
        }catch(Exception $e)
        {
            Sesion()->flash('error','Lỗi ');
            \Log::error($e->getMessage());
            return false;
        }
        return true;
    }
    public function get()
    {
        return Coupon::orderbyDesc('coupon_id')->paginate(10);
    }
    public function update($request, $coupon)
    {
        try{
            $coupon ->fill($request->input());
            $coupon -> save();
            Session()->flash('success','Chỉnh sửa thành công');
        } catch (\Exception $e) 
        {
            Session()->flash('error','Lỗi ');
            \Log::error($e->getMessage());
            return false;
        }
        return true;
    }
    public function destroy($request)
    {   
        $coupon = Coupon::where('coupon_id', $request->input('coupon_id'))->first();
        if($coupon) {
            $coupon->delete();
            return true;

        }
        return false;
        
    }
}