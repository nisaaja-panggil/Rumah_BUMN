<?php

use App\Http\Controllers\barangcontroller;
use App\Http\Controllers\CetakController;
use App\Http\Controllers\hutangcontroller;
use App\Http\Controllers\kascontroller;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\penitipancontroller;
use App\Http\Controllers\UserController;
use App\Livewire\Orders;
use App\Livewire\Penjualans;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('dasbord',[
        "title"=>"Dashboard"
    ]);
})->middleware('auth');
Route::resource('penitipan', penitipancontroller::class)->middleware('auth');
Route::resource('hutang', hutangcontroller::class)->middleware('auth');
Route::get('login',[LoginController::class,'loginView'])->name('login');
route::post('login',[LoginController::class,'authenticate']);
Route::post('logout',[LoginController::class,'logout'])->middleware('auth');
Route::resource('user',UserController::class)->except('show','destroy','create','update','edit')->middleware('auth');
Route::resource('produk', barangcontroller::class)->middleware('auth');
Route::POST('caribarang',[barangcontroller::class,'cari'])->name('cariproduk')->middleware('auth');
Route::get('penjualan',function(){
    return view('penjualan.index',[
        "title"=>"penjualan"
    ]);
})->middleware('auth');
Route::get('orders',function(){
    return view('penjualan.orders',[
        "title"=>"order"
    ]);
})->middleware('auth');
Route::get('cetakReceipt',[CetakController::class,'receipt'])->name('cetakReceipt')->middleware('auth');
Route::get('orders/{id}', function ($id) {
    return view('penjualan.orders', [
        "title" => "Order Detail",
        "order" => App\Models\Penjualan::findOrFail($id), // Ambil data penjualan berdasarkan ID
    ]);
})->name('orders.show')->middleware('auth');
Route::get('/riwayat-penjualan', [Orders::class, 'riwayat'])->name('riwayat-penjualan')->middleware('auth');
Route::resource('kas', KasController::class)->middleware('auth');
Route::get('/penjualan/laporan', penjualans::class)->name('penjualan.laporan')->middleware('auth');