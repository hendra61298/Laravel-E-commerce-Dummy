<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ImgProduct;
use App\Models\Transaksi;
use App\Models\TransaksiProduct;
use App\Exports\TransaksiExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\User;
use File;
use Auth;
class ProductController extends Controller
{

function transaksi(){

    $transaksi = Transaksi::with('detail.product')->orderBy("id")->get();
    return view('adminpage.pages.transaksi',["transaksi" => $transaksi]);

}

    function list(){
        $product = Product::orderBy("id","desc")->get();
        return view('adminpage.pages.product',["product" => $product]);
    }

    function destroy($id){
        $dataimg = Product::where('id', $id)->first();
        if($dataimg){
            $urlproduct= $dataimg->img_url;
                if(File::exists($urlproduct)) {
                    File::delete($urlproduct);
                }
        }
        $dataproductimg = ImgProduct::where('product_id',$id)->get();  
        foreach($dataproductimg as $dp){
            $url = $dp->img_url;
            error_log($url);
            if(File::exists($url)) {
                File::delete($url);
            }
        }
         $deletedimg = ImgProduct::where('product_id',$id)->delete();  
         $deleted = $dataimg->delete();
         if($deleted){
             return 1;
         }else{
             return 0;
         }   
    }

    function buy(){
        $product = Product::orderBy("id","desc")->get();
        return view('adminpage.pages.buy',["product" => $product]);
    }

    public function upload(){
        return view('upload');
	}

    function destroyemail($id){
        $deleted = User::where('id', $id)->delete();
        if ($deleted){
            return 1;
        } else {
            return 0;
        }
    }

}
