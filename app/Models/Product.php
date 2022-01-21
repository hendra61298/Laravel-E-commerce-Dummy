<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\ImgProduct;
class Product extends Model
{
    use SoftDeletes;
    
    protected $table = 'product';
    protected $guarded = [];  

public function productimg()
        {
            return $this->hasMany(ImgProduct::class, 'product_id', 'id');
        }
}