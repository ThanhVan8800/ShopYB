<?php

namespace App\Http\View\Composers; 

use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;


class CartComposer
{

    /**
     * Create a new profile composer.
     *
     * @param  \App\Repositories\UserRepository  $users
     * @return void
     */
    protected $users;
    public function __construct()
    {

    }

    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    
    public function compose(View $view)
    {
            $carts = Session::get('carts');
            // dd($carts);
            if(is_null($carts)) {
                $products =[];
            }
            else{
                $productId = array_keys($carts);
                $products = Product::select('id', 'name', 'price', 'price_sale', 'thumb')
                ->where('active', 1)
                ->whereIn('id', $productId)
                ->get();

        }
            $view->with('products',$products);

    }
    
}
// $carts = Session::get('carts');
        // dd($carts);
        // $carts = Session::get('carts');
        // if(is_null($carts)) return [];
        // $productId = array_keys($carts);
        // $product = Product:: select('id', 'name', 'price', 'price_sale','thumb')
        // ->where('active',1)
        // ->whereIn('id',$productId)
        // ->get();
        // $view->with('product', $product);