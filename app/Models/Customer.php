<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cart;
class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 
        'phone', 
        'address',
        'email',
        'content'
    ];
    // 1 khách hàng có thể mua nhiều sản phẩm
    public function carts()
    {
        return $this->hasMany(Cart::class,'customer_id','id');
    }
}
