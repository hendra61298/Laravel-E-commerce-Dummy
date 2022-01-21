<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::group(['prefix' => 'home'], function () {
    Route::get('/loginview', [HomeController::class, 'loginview'])->name('home.loginview');
    Route::get('/regisnview', [HomeController::class, 'regisview'])->name('home.regisview');
    Route::get('/forgotnview', [HomeController::class, 'forgotview'])->name('home.forgotview');
    Route::get('/successendemail', [HomeController::class, 'forgottokenview'])->name('home.successendemail');
    Route::post('/forgot', [HomeController::class, 'forgot'])->name('home.forgot');
    Route::get('/forgot/{token}', [HomeController::class, 'forgottoken'])->name('home.forgottoken');
    Route::post('/forgot/update', [HomeController::class, 'passwordupdate'])->name('home.passwordupdate');
    Route::middleware(['auth'])->group(function () {
        Route::get('/transaksi', [HomeController::class,'transaksi'])->name('home.transaksi');
        Route::get('/chartview', [HomeController::class, 'chartview'])->name('home.chartview');
        Route::get('/profileview', [HomeController::class, 'profileview'])->name('home.profilview');
        Route::get('/datatable', [HomeController::class, 'datatable'])->name('home.datatable');
        Route::get('/product/{id}', [HomeController::class, 'singleproduct'])->name('home.singleproduct');
        Route::get('/shoppage', [HomeController::class, 'shoppage'])->name('home.shoppage');
        
    });
    Route::post('/', [HomeController::class, 'createcustomer'])->name('home.createcustomer');
    Route::post('/checkout', [HomeController::class, 'checkout'])->name('home.checkout');
    Route::post('/update', [HomeController::class, 'update'])->name('home.update');
    Route::get('/logout', [HomeController::class,'logout'])->name('home.logout');
    Route::post('/login', [HomeController::class, 'login'])->name('home.login');
    
});


Route::group(['prefix' => 'admin'], function () {
        Route::get('/logout', [AdminController::class,'logout'])->name('admin.logout');
        Route::post('/login', [AdminController::class, 'login'])->name('admin.login');
        Route::get('/admin', [AdminController::class,'admin'])->name('admin.admin');
        Route::get('/add', [AdminController::class,'add'])->name('admin.add');
        Route::get('/addrole', [AdminController::class,'addroleview'])->name('admin.addrole');
        Route::get('/category', [AdminController::class,'category'])->name('admin.category');
        Route::post('/category', [AdminController::class,'categoryadd'])->name('admin.categoryadd');
        Route::post('/',[AdminController::class,'create'])->name('admin.product.create');
        Route::get('/export_excel', [AdminController::class,'export_excel'])->name('admin.product.export_excel');
        Route::get('/edit/{id}', [AdminController::class,'edit'])->name('admin.product.edit');
        Route::post('/update', [AdminController::class,'update'])->name('admin.product.update');
        Route::post('/role/update', [AdminController::class,'updaterole'])->name('admin.product.updaterole');
        Route::post('/role/add', [AdminController::class,'addrole'])->name('admin.product.addrole');


            Route::group(['prefix' => 'product'], function () {
            Route::get('/list', [ProductController::class, 'list'])->name('admin.product.list');
            Route::get('/buy', [ProductController::class,'buy'])->name('admin.product.buy');
            Route::get('/transaksi', [ProductController::class,'transaksi'])->name('admin.product.transaksi');
            Route::delete('/{id}', [ProductController::class,'destroy'])->name('admin.product.destroy');
            });
    });