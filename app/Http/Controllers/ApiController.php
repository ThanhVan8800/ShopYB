<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ApiController extends Controller
{
    public function ajaxSearch()
    {
        $data = Product::search()->get();
        // $result = [
        //     'status' => true,
        //     'message' => 'Tim duoc  ' . $data->count(). '  ket qua',
        //     'data' => $data
        // ];
        return $data;
    }
}
