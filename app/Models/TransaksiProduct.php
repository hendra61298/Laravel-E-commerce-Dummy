<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class TransaksiProduct extends Model
{
    protected $table = 'transaksi_barang';
    protected $guarded = [];  

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'id_product')->withTrashed();
    }
}
