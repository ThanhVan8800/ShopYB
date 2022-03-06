<?php
namespace App\Http\Services\SLider;

use App\Models\Slider;
use GuzzleHttp\Psr7\Request;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class SliderAdminService{


    public function insert($request)
    {
        try{
            #$request->except('_token)
            Slider::create($request->input());
            Session()->flash('success','Thêm slider mới thành công');
        }catch(\Exception $err)
        {
            Session()->flash('error','Lỗi');
            Log::info($err->getMessage());
            return false;
        }
        return true;
    }
    public function get()
    {
        return Slider::orderByDesc('id') -> paginate(15);
    }
    public function update($request, $slider)
    {
        try{
            $slider -> fill( $request->input());
            $slider->save();

            Session() -> flash('success', 'Cập nhật Slider thành công');

        }catch(\Exception $err)
        {
            Session() -> flash('error','Cập nhật Slider lỗi');

            Log::info($err->getMessage());
            return false;
        }
        return true;
    }
    public function destroy( $request)
    {
        $slider = Slider::where('id', $request->input('id'))->first();
        if($slider)
        {
                $path = str_replace('storage' , 'public', $slider->thumb);
                Storage::delete($path);
                $slider->delete();

            return true;
        }
        return false;
    }
    public function show()
    {
        return Slider::where('active',1) -> orderByDesc('sort_by')->get();
    }
}