<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'content',
        'menu_id',
        'price',
        'price_sale',
        'active',
        'thumb'
    ];
    // liên kết product vs menu, mỗi sp có 1 menu hasone
    public function menu()
    {
        return $this->hasOne(Menu::class, 'id', 'menu_id')
        ->withDefault(['name' => ' ']);
    }
    public function scopeSearch($query)
    {
        if(request('key')){
            $key = request('key');
            $query = $query->where('name','like','%' .$key . '%');
        }
        return $query;
    }

}
