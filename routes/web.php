<?php

use App\Http\Controllers\PembeliController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
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

//  Route::get('/', function () {
//      return view('welcome');
// });


Route::get('/', [LoginController::class, 'ShowLoginForm'])->name('login.index');
Route::get('/pembeli', [PembeliController::class, 'index'])->name('pembeli.index');
Route::get('/album', [AlbumController::class, 'index'])->name('album.index');
Route::get('/pembelian', [PembelianController::class, 'index'])->name('pembelian.index');

Route::prefix('pembeli')->group(function(){
    Route::get('add', [PembeliController::class, 'create'])->name('pembeli.create');
    Route::post('store', [PembeliController::class, 'store'])->name('pembeli.store');
    Route::get('edit/{id}', [PembeliController::class, 'edit'])->name('pembeli.edit');
    Route::post('update/{id}', [PembeliController::class, 'update'])->name('pembeli.update');
    Route::post('delete/{id}', [PembeliController::class, 'delete'])->name('pembeli.delete');
    Route::post('softdelete/{id}', [PembeliController::class, 'softdelete'])->name('pembeli.softdelete');
}); 


Route::prefix('album')->group(function(){
    Route::get('add', [AlbumController::class, 'create'])->name('album.create');
    Route::post('store', [AlbumController::class, 'store'])->name('album.store');
    Route::get('edit/{id}', [AlbumController::class, 'edit'])->name('album.edit');
    Route::post('update/{id}', [AlbumController::class, 'update'])->name('album.update');
    Route::post('delete/{id}', [AlbumController::class, 'delete'])->name('album.delete');
    Route::post('softdelete/{id}', [AlbumController::class, 'softdelete'])->name('album.softdelete');
});

Route::prefix('pembelian')->group(function(){
    Route::get('add', [PembelianController::class, 'create'])->name('pembelian.create');
    Route::post('store', [PembelianController::class, 'store'])->name('pembelian.store');
    Route::get('edit/{id}', [PembelianController::class, 'edit'])->name('pembelian.edit');
    Route::post('update/{id}', [PembelianController::class, 'update'])->name('pembelian.update');
    Route::post('delete/{id}', [PembelianController::class, 'delete'])->name('pembelian.delete');
    Route::post('search', [PembelianController::class, 'search'])->name('pembelian.search');
});






Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
