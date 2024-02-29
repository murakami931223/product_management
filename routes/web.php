<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/list', [App\Http\Controllers\ProductController::class, 'showList'])->name('list');

Route::get('/productregist',[App\Http\Controllers\ProductController::class, 'showProductregistForm'])->name('productregist');

//商品登録機能用
Route::post('/productregist',[App\Http\Controllers\ProductController::class, 'productregistSubmit'])->name('productregist.submit');

// 商品の削除
Route::DELETE('/products/{product}', [App\Http\Controllers\ProductController::class, 'delete'])->name('product.delete');

//商品詳細画面表示
Route::get('/detail/{id}', [App\Http\Controllers\ProductController::class, 'showDetail'])->name('detail');

//商品編集画面表示
Route::get('/edit/{id}', [App\Http\Controllers\ProductController::class, 'showEdit'])->name('edit');

//商品編集
Route::post('/edit/{id}',[App\Http\Controllers\ProductController::class, 'update'])->name('edit.submit');
