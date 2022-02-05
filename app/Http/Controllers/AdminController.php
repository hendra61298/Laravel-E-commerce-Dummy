<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Transaksi;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TransaksiExport;
use App\Models\ImgProduct;
use App\Models\Category;
use App\Models\RoleName;
use Validator;
use JWTAuth;

use File;
class AdminController extends Controller{

function registration(){
return view('registration');

}

public function store()
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
        "role" => 1,

    ]);
    auth()->login($user);
    
    return redirect()->route('home.welcome');
}


public function login(Request $request)
{
    $user = User::where("email",$request->email)->where("password",md5($request->password))->first();

    if(!$user){
        return redirect()->route('home.welcome');
    }
    
    Auth::login($user);

    return redirect()->route('home.landing');

}
    
protected function authenticated(Request $request, $user) 
{
    return redirect()->intended();
}


function forgot(){
    return view('forgot');
    }


function landing(){
    return view('landing');
    }

public function logout(Request $request) {
    Auth::logout();
    return redirect()->route('home.index');
    } 


function admin(){
    $users = User::orderBy("id","desc")->get();
    $role = RoleName::get();
    return view('adminpage.pages.admin',["users" => $users, 'role'=>$role]);
}
function add(){
    $category = Category::get();
    return view('adminpage.pages.add',['category' =>$category]);
}  
function category(){
    return view('adminpage.pages.category');
}  
function categoryadd(Request $request){
    $category = Category::insert(
        [
            'name' => $request->category,
        ]
    );
    return redirect()->route('admin.category');
}  

function create(Request $request){
    $image_64 = $request['aftercrop']; 
    $replace = substr($image_64, 0, strpos($image_64, ',')+1);  
    $image = str_replace($replace, '', $image_64); 
    $image = str_replace(' ', '+', $image); 
    $imageName = Str::random(10).'.jpg';
    file_put_contents(public_path()."/images/".$imageName,base64_decode($image));
    
    $product = Product::create(
        [
            'name' => $request->name,
            'qty'=> $request->jumlah,
            'price'=> str_replace(".","",$request->price),
            'desc'=> $request->desc,
            'img_url'=>"images/".$imageName,
            'category' => $request->category
        ]
    );
    if($file = $request->file('image1')){
        foreach($file as $f){
         $imageName = Str::random(10).'.jpg'; 
         $ext = strtolower($f->getClientOriginalExtension());
         $image_full_name = $imageName.'.'.$ext;
         $uploade_path = 'images/';
         $image_url = $uploade_path.$image_full_name;
         $f->move($uploade_path,$image_full_name);

        ImgProduct::insert([
        'img_url' =>$image_url,
        'product_id' => $product->id,
    ]);
        }
    }
   

    //TODO add another image

    return redirect()->route('admin.product.list');


}

public function export_excel()
{
    return Excel::download(new TransaksiExport, 'transaksi.xlsx');
}
 
function edit($id){
    $data = Product::with('productimg')->where('id', $id)->first();
    $category = Category::get();
    if ($data){
        return view('adminpage.pages.edit',["data" => $data , 'category' =>$category]);
    } else {
        return redirect()->route('admin.product.list');
    }
}

function update(Request $request){
    if($file = $request->file('image1')){
         $imageName = Str::random(10); 
         $ext = strtolower($file->getClientOriginalExtension());
         $image_full_name = $imageName.'.'.$ext;
         $uploade_path = 'images/';
         $image_url = $uploade_path.$image_full_name;
         $file->move($uploade_path,$image_full_name);
         $imgproduct = ImgProduct::where('id',$request->idimage1)->first();
       
        if($imgproduct){
            $imgdelet = $imgproduct->img_url;
            if(File::exists($imgdelet)) {
                File::delete($imgdelet);
            }
            ImgProduct::where('id',$request->idimage1)->update([
                'img_url' =>$image_url,
            ]); 
        }else{
            ImgProduct::insert([
                'img_url' =>$image_url,
                'product_id' =>  $request->id,
            ]); 
        }
    }


    if($file = $request->file('image2')){
        $imageName = Str::random(10); 
        $ext = strtolower($file->getClientOriginalExtension());
        $image_full_name = $imageName.'.'.$ext;
        $uploade_path = 'images/';
        $image_url = $uploade_path.$image_full_name;
        $file->move($uploade_path,$image_full_name);
        $imgproduct = ImgProduct::where('id',$request->idimage2)->first();

       
        if($imgproduct){
            $imgdelet = $imgproduct->img_url;
            if(File::exists($imgdelet)) {
                File::delete($imgdelet);
            }
            ImgProduct::where('id',$request->idimage2)->update([
                'img_url' =>$image_url,
            ]); 
        } else{
            ImgProduct::insert([
                'img_url' =>$image_url,
                'product_id' => $request->id,
            ]); 
        }
   }
   if($file = $request->file('image3')){

        $imageName = Str::random(10); 
        $ext = strtolower($file->getClientOriginalExtension());
        $image_full_name = $imageName.'.'.$ext;
        $uploade_path = 'images/';
        $image_url = $uploade_path.$image_full_name;
        $file->move($uploade_path,$image_full_name);
        $imgproduct = ImgProduct::where('id',$request->idimage3)->first();

        if($imgproduct){
            $imgdelet = $imgproduct->img_url;
            if(File::exists($imgdelet)) {
                File::delete($imgdelet);
            }
            ImgProduct::where('id',$request->idimage3)->update([
                'img_url' =>$image_url,
            ]); 
        }else {
            ImgProduct::insert([
                'img_url' =>$image_url,
                'product_id' => $request->id,
            ]); 
        }
    }


    //if($request->jumlah<=0){
        
     //   $deleted = Product::where('id',$request->id)->delete();
      //  $deleted = ImgProduct::where('product_id',$request->id)->delete();
    //} else
    if( $request['aftercrop']==''){
        if($request->jumlah<=0){
            Product::where("id", $request->id)->update(
                [
                    'qty'=>0,
                    'price'=> str_replace(".","",$request->price),
                    'desc'=> $request->desc,
                    'category' => $request->category,
                ]
            );       
            }else{
                Product::where("id", $request->id)->update(
                    [
                        'qty'=> $request->jumlah,
                        'price'=> str_replace(".","",$request->price),
                        'desc'=> $request->desc,
                        'category' => $request->category,
                    ]
                );       
            }
    } else {
        $image_64 = $request['aftercrop']; 
        $replace = substr($image_64, 0, strpos($image_64, ',')+1);  
        $image = str_replace($replace, '', $image_64); 
        $image = str_replace(' ', '+', $image); 
        $imageName = Str::random(10).'.jpg';
        file_put_contents(public_path()."/images/".$imageName,base64_decode($image));
        $imgdelet = Product::where("id", $request->id)->first()->img_url;
        if(File::exists($imgdelet)) {
            File::delete($imgdelet);
        }
        if($request->jumlah<=0){
        Product::where("id", $request->id)->update(
            [
                'qty'=> 0,
                'desc'=> $request->desc,
                'price'=> str_replace(".","",$request->price),
                'img_url'=> "images/".$imageName
            ]
         );     
        }else{
        Product::where("id", $request->id)->update(
            [
                'qty'=> $request->jumlah,
                'desc'=> $request->desc,
                'price'=> str_replace(".","",$request->price),
                'img_url'=> "images/".$imageName
            ]
            );     
        }
        
     }
    return redirect()->route('admin.product.list');
} 

function updaterole(Request $request){
      
    User::where("id", $request->id)->update(
        [
            'role'=> $request->role,
            
        ]
    );
return redirect()->route('admin.admin');
} 
function addrole(Request $request){
      
    RoleName::insert(
        [
            'name'=> $request->role,
        ]
    );
return redirect()->route('admin.addrole');
} 

public function addroleview(){
    return view('adminpage.pages.role');
} 

function admin_list(Request $request){
    $users= Product::orderBy("id","DESC");

    $startdate = $request->start_date;
    $enddate = $request->end_date;
    $searchname = $request->name_search;
    if ($startdate){
        $users = $users->where("created_at",">=",$startdate);
    }
    if($enddate){
        $users = $users->where("created_at","<=",$enddate);
    }
    if($searchname){
        $users = $users->where("name","like",'%'.$searchname.'%');
    }
    $users = $users->paginate();
    return $users;
}

function admin_show($id){
    $users = Product::where('id',$id)->orderBy("id","desc")->get();

    return $users;
}

function admin_update($id, Request $request){
    $users = Product::where('id',$id)->orderBy("id","desc")->get();
    if($users){
        Product::where("id",$id)->update( $request->all());
    }
    $users = Product::where('id',$id)->orderBy("id","desc")->get();
    return $users;
}

function admin_create(Request $request){
    $image_64 = $request['img']; 
    $replace = substr($image_64, 0, strpos($image_64, ',')+1);  
    $image = str_replace($replace, '', $image_64); 
    $image = str_replace(' ', '+', $image); 
    $imageName = Str::random(10).'.jpg';
    file_put_contents(public_path()."/images/".$imageName,base64_decode($image));

    $data = Product::create([
        'name'=>$request->name,
        'qty'=>$request->qty,
        'price'=>$request->price,
        'img_url'=>"images/".$imageName,
        'desc'=> $request->desc,
        'category'=>$request->category
    ]);
    return $data;   
}

function admin_delete($id){

   return Product::where("id",$id)->delete();
}

function user_login(Request $request){
    $validator = Validator::make($request->all(), [
        'email' => 'required|email',
        'password' => 'required|string|min:6',
    ]);
    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }
    if (! $token = auth('api')->attempt($validator->validated())) {
        return response()->json(['error' => 'Unauthorized'], 401);
    }
        
    return response()->json([
        'success' => true,
        'token' => $token,
    ]);
}

function user_logout(){
    auth()->logout();
    JWTAuth::invalidate(JWTAuth::getToken());
    return response()->json(['message' => 'User successfully signed out']);
}

function user_list(){
    $user = User::orderBy("id","desc")->get();
    
    return $user;
}

function user_show($id){
    $users = User::where('id',$id)->get();

    return $users;
}
function user_delete($id){

    return User::where("id",$id)->delete();
 }

 function user_create(Request $request){
    $this->validate(request(), [
        'name' => 'required',
        'email' => 'required|email',
        'password' => 'required'
    ]);
    
    $data = User::create([
        'name'=>$request->name,
        'email'=>$request->email,
        'password'=>bcrypt($request->password),
        'role'=>$request->role
  
    ]);

    return response()->json([
            'success' => true,
            'message' => 'User created successfully',
            'data' => $data
        ], ); 
}

function user_update($id, Request $request){
    $users = User::where('id',$id)->orderBy("id","desc")->get();
    if($users){
        Product::where("id",$id)->update( $request->all());
    }
    $users = Product::where('id',$id)->orderBy("id","desc")->get();
    return $users;
}

}