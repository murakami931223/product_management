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

Route::get('/list', [App\Http\Controllers\ItemController::class, 'showList'])->name('list');

Route::get('/itemregist',[App\Http\Controllers\ItemController::class, 'showItemregistForm'])->name('itemregist');

//商品登録機能用
Route::post('/itemregist',[App\Http\Controllers\ItemController::class, 'itemregistSubmit'])->name('regist.submit');

// 商品の削除
Route::DELETE('/items/{item}', [App\Http\Controllers\ItemController::class, 'delete'])->name('item.delete');

//商品詳細画面表示
Route::get('/detail/{id}', [App\Http\Controllers\ItemController::class, 'showDetail'])->name('detail');

//商品編集画面表示
Route::get('/edit/{id}', [App\Http\Controllers\ItemController::class, 'showEdit'])->name('edit');

//商品編集
Route::post('/edit/{id}',[App\Http\Controllers\ItemController::class, 'update'])->name('edit.submit');
