<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\TransaksiProduct;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $guarded = [];  

    public function detail()
    {
        return $this->hasMany(TransaksiProduct::class, 'id_transaksi', 'id');
    }
}
