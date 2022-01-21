<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

use App\Models\Transaksi;

use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class TransaksiExport implements FromCollection, WithHeadings, WithMapping,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $data;
  

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function collection()
    {
        return  Transaksi::with('detail.product')->orderBy("id")->get();

    }

    public function map($row): array{
        $name = "";
        $jumlah = "";
        $harga = "";
        foreach($row->detail as  $d){
            $name  = $name.$d->product->name;
            $jumlah= $jumlah.$d->jumlah;
            $harga = $harga.$d->product->price;
          
        }
      
        $fields = [
           $row->transaksinumber,
           $name."\r\n",
           $jumlah."\r\n",
           $harga,
           $row->barang,
           $row->total,
           $row->created_at,  
      ];
     return $fields;
 }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function headings() :array
    {
        return [
            'No Transaksi',
            'Nama Product',
            'Jumlah Product',
            'Harga Product',
            'Total Product',
            'Total Harga',
            'Tanggal Transaksi',
        ];
    }


}
