<?php

use App\Http\Controllers\JamrekController;
use App\Http\Controllers\KabupatenController;
use App\Http\Controllers\KomoditasController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\IUPController;

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

Route::get('/', [UserController::class, 'index']);

Route::resource('user', UserController::class);

Route::resource('iup', IUPController::class);

Route::resource('jamrek', JamrekController::class);

Route::resource('komoditas', KomoditasController::class);

Route::resource('kabupaten', KabupatenController::class);

Route::get('/sidebar', function () {
    return view('sidebar');
});

Route::get('/jampas', function () {
    return view('tableJamPas');
});
Route::get('/sumberdaya', function () {
    return view('sumberdaya');
});
Route::get('/cadangan', function () {
    return view('cadangan');
});
Route::get('/produksi', function () {
    return view('tableProduksi');
});
Route::get('/inputProduksi', function () {
    return view('inputProduksi');
});
Route::get('/rawInventory', function () {
    return view('rawInventory');
});
Route::get('/tableBuktiBayar', function () {
    return view('tableBuktiBayar');
});
Route::get('/tableKTT', function () {
    return view('tableKTT');
});
Route::get('/statusKTT', function () {
    return view('statusKTT');
});


