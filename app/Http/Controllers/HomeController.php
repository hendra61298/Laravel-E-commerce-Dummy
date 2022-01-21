<?php
namespace App\Http\Controllers;
use URL;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Transaksi;
use App\Models\TransaksiProduct;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;



class HomeController extends Controller{


  public function chartview(){
    $product  = Product::orderBy("updated_at","desc")->get();
    return view('tampilan.pages.chart',["product" => $product]);
  }



  public function index(){

    $product  = Product::orderBy("updated_at","desc")->get();
    $productminuman = Product::where('category','Minuman')->limit(3)->get();
    $productmakanan = Product::where('category','Makanan')->limit(3)->get();
    $productbuah= Product::where('category','Buah')->limit(3)->get();
    return view('tampilan.pages.home',[
      "product" => $product,
      "productmakanan" => $productmakanan,
      "productminuman" => $productminuman,
      'productbuah'=> $productbuah
    ]);
  }

  

  public function loginview(){

    return view('tampilan.login');
  }

  public function regisview(){

    return view('tampilan.regis');
  }

  public function forgotview(){

    return view('tampilan.forgot');
  }

  public function createcustomer()
  {
      $this->validate(request(), [
          'name' => 'required',
          'email' => 'required|email',
          'password' => 'required'
      ]);

      $user = User::create([
          "name" => request()->name,
          "email" => request()->email,
          "password" => md5(request()->password),
          "role" => 'User'

      ]);
      auth()->login($user);
      
      return redirect()->route('home.index');
  }

  public function logout(Request $request) {
    Auth::logout();
    return redirect()->route('home.index');
    } 


    public function login(Request $request)
  {
      $user = User::where("email",$request->email)->where("password",md5($request->password))->first();

      if(!$user){
          return redirect()->route('home.loginview');
      }
      
      Auth::login($user);

      return redirect()->route('home.index');

  }

  function random_string($length) {
    $key = '';
    $keys = array_merge(range(0, 9), range('a', 'z'));

    for ($i = 0; $i < $length; $i++) {
        $key .= $keys[array_rand($keys)];
    }

    return $key;
  }

  public function checkout(Request $request)
  {   
      //hitung total harga & total product
      $total_price = array_sum(array_map(function ($ar) {return $ar['price'];}, $request->arraychart));
      $total_jumlah = array_sum(array_map(function ($ar) {return $ar['jumlah'];}, $request->arraychart));
      $transaksinumber= strtoupper($this->random_string(18));
      $transaksi = Transaksi::create(
          [
              'barang' => $total_jumlah,
              'total'=> $total_price,
              'user_id'=> Auth::user()->id,
              'transaksinumber' => $transaksinumber,
          ]
      );

      $str_name_product = "";
      foreach ($request->arraychart as $arraychart) {
        
          $p = Product::where("id", $arraychart["id"])->first();
          if ($p){
            Product::where("id", $arraychart["id"])->update(
                [
                    'qty'=> $p->qty - $arraychart["jumlah"]
                ]
            );

            TransaksiProduct::create(
                [
                    'id_product' => $p->id,
                    'id_transaksi'=> $transaksi->id,
                    'jumlah'=>$arraychart["jumlah"],
                    'price'=>$arraychart["price"],
                ]
            );

            $str_name_product = $str_name_product . $p->name ."<br>";
          } else {
            return 0;
          }
          
          if($p->qty - $arraychart["jumlah"]==0){
              $deleted = Product::where('id',$p->id)->delete();
          }   
          
      }
      $details = [
        "name" => $str_name_product,
        "price" => $total_price
      ];

      \Mail::to(Auth::user()->email)->send(new \App\Mail\SendCheckout($details,"Checkout Produk"));
      return 1;
  }

  public function profileview(){
  
    return view('tampilan.pages.index');

  }

  public function update(Request $request)
  {
    $this->validate($request, [
          'password'  => 'confirmed',
        
      ]);

    $user = User::where('id', Auth::user()->id)->first();
    $user->name = $request->name;
    $user->email = $request->email;
    $user->nomor = $request->nomor;
    $user->alamat = $request->alamat;
    
    if(!empty($request->password))
    {
      $user->password = Hash::make($request->password);
    }
    
    $user->update();

    return redirect()->route('home.profilview');;
  }

  public function transaksi(){
    return view('tampilan.pages.transaksi');

  }

  public function forgot(Request $request)
  {
    $token = Str::random(40);

    //save to db remember token
    $user = User::where('email',$request->email)->first();
    if($user){
      
      $details = [
        "token" => $token,
        "url" =>  URL::to('/home/forgot')."/".$token,
        "name" => $user->name
      ];

      $user->remember_token = $token;
      $user->update();
      \Mail::to($request->email)->send(new \App\Mail\ForgotPassword($details,"reset password"));
    }
    return redirect()->route('home.successendemail');;
  }

  public function forgottoken($token)
  {
    $user = User::where('remember_token',$token)->first();
    if($user){
      return view('resetpassword',["token" => $token]);
    }
    return redirect()->route('home.index');
  }


public function forgottokenview()
  {

    return view('successendemail');
  }

  public function passwordupdate(Request $request){
      
    User::where("remember_token", $request->token)->update(
        [
            'password'=> md5(request()->password),
            'remember_token'=> null,
        ]
    );
    return redirect()->route('home.loginview');
  }
  
  public function datatable(){
  $dataDb =Transaksi::with('detail.product')->where('user_id',Auth::user()->id)->get();
    // ->get();
  return DataTables::of($dataDb)->make(true);
  }

 public function singleproduct($id){
  $product  = Product::with('productimg')->where("id",$id)->first();
  return view('tampilan.pages.product',["product" => $product]);
 }


 public function shoppage(Request $request){
  $cari = $request ->cari;
  $product  = Product::orderby('id', 'desc')->where('name','like',"%".$cari."%")->orWhere('category','like',"%".$cari."%")->paginate(5);
  return view('tampilan.pages.shoppage',["product" => $product]);
 }
}