<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\CartService;
use App\Models\Customer;
class CartController extends Controller
{
    protected $cart;
    public function __construct(CartService $cart)
    {
        $this->cart = $cart;
    }
    public function index()
    {
        return view('admin.cart.customers',[
            'title' => 'Giỏ hàng',
            'customers' => $this->cart->getCustomers()
        ]);
    }
    public function show(Customer $customer)
    {
        return view('admin.cart.detail',[
            'title' => 'Chi tiết giỏ hàng của   ' . $customer->name,
            'customer' => $customer,
            'carts' => $customer->carts()->with(['product' => function ($query){
                $query->select('id','name', 'thumb');
            }])
            ->get()
        ]);
    }
}
