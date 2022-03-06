<?php

namespace App\Http\Services\Product;


use App\Models\Product;

class ProductService
{
    const LIMIT = 16;
    public function get($page = null)
    {
        return  Product:: select('id','name','price','price_sale','thumb')
            ->orderbyDesc('id')
            ->when($page != null, function ($query) use ($page){
                $query -> offset($page * self::LIMIT);
            })
            ->limit(self::LIMIT)
            ->get();
    }
    public function show($id)
    {
        return Product::where('id', $id)-> where('active', 1)->with('menu')-> firstOrfail();
    }
    public function more($id)
    {
        return Product:: select('id', 'name', 'price','price_sale','thumb')
                ->where('active', 1)
                ->where('id' ,'!=', $id)
                -> orderbyDesc('id')
                ->limit(8)
                -> get();
    }
}