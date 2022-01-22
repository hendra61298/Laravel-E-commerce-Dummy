<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/admin', [AdminController::class, 'admin_list']);
Route::get('/admin/{id}', [AdminController::class, 'admin_show']);
Route::put('/admin/{id}', [AdminController::class, 'admin_update']);
Route::post('/admin', [AdminController::class, 'admin_create']);
Route::post('/admin/delete/{id}', [AdminController::class, 'admin_delete']);
