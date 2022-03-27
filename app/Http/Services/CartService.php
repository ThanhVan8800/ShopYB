<?php

namespace App\Http\Services;
use Illuminate\Support\Facades\Session;
use App\Models\Product;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use App\Models\Customer;
use App\Models\Cart;
use App\Jobs\SendMail;

class CartService 
{
    public function create($request)
    {
        // số lượng sản phẩm && mã sản phẩm
            $qty = (int) $request->input('num_product');
            $product_id = (int) $request->input('product_id');
            if($qty <= 0 || $product_id <= 0)
            {
                Session()->flash('error','Lỗi nhập số lượng hoặc sản phẩm không chính xác');
                return false;
            }
            // Session::forget('carts');
            $carts = Session::get('carts');
            // dd($carts);
            // dd(Session::get('carts'));
            if(is_null($carts)){
                Session::put('carts',[
                    $product_id => $qty
                ]);
                return true;
            }
            // dd($carts);
            $exists = Arr::exists($carts, $product_id);
            // dd($carts);
            // arr để kiểm tra cái product -id có hay chưa
            if($exists){
                // $qtyNew = $carts[$product_id] + $qty;
                $carts[$product_id] = $carts[$product_id] + $qty;
                Session::put('carts',$carts);
                return true;
            }
            // dd($carts);
            $carts[$product_id] = $qty;
            Session::put('carts', $carts);
            return true;
    }
    public function getProducts()
    {
            $carts = Session::get('carts');
            // dd($carts);
            if(is_null($carts)) return [];
            // dd($carts);
            $productId = array_keys($carts);
            return Product:: select('id', 'name', 'price', 'price_sale','thumb')
                            ->where('active',1)
                            ->whereIn('id',$productId)
                            ->get();
    }
    public function update($request)
    {
        Session::put('carts', $request->input('num_product'));
        return true;
    }
    public function destroy($id)
    {
        $carts = Session::get('carts');
        

        unset($carts[$id]);
        Session::put('carts',$carts);
        return true;
       // dd($carts);
    }
    public function addCart($request)
    {
        try{
            // nếu nó đang chạy mà bị lỗi thì sẽ rollback lại
            DB::beginTransaction();
            $carts = Session::get('carts');
            if(is_null($carts)) return false;
            $customer = Customer::create([
                'name' => $request->input('name'),
                'phone' => $request->input('phone'),
                'email' => $request->input('email'),
                'address' => $request->input('address'),
                'content' => $request->input('content'),
            ]);
            
            $this->infoProductCart($carts, $customer->id);
            DB::commit();
            Session::flash('success','Đặt hàng thành công');
            //queue
            SendMail::dispatch($request->input('email'))->delay(now()->addSeconds(8));
            Session::forget('carts');
        }
        catch(Exception $e){
            DB::rollback();
            Session::flash('error','Đặt hàng không thành công');
            return false;
        }
        return true;
    }
    protected function infoProductCart($carts, $customer_id)
    {
        $productId = array_keys($carts);
        $products =  Product:: select('id', 'name', 'price', 'price_sale','thumb')
                        ->where('active',1)
                        ->whereIn('id',$productId)
                        ->get();
        $data = [];
        foreach ($products as $product)
        {
            $data = [
                    'customer_id' => $customer_id,
                    'product_id' => $product->id,
                    'qty' => $carts[$product->id],
                    'price' => $product->price_sale != 0 ? $product->price_sale : $product->price

            ];  
        }
        return Cart::insert($data);
    }
    public function getCustomers()
    {
        return Customer:: orderbyDesc('id')->paginate(15);
    }
}