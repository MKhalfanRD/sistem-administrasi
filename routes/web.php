<?php

use App\Http\Controllers\CadanganController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\JampasController;
use App\Http\Controllers\JamrekController;
use App\Http\Controllers\KabupatenController;
use App\Http\Controllers\KomoditasController;
use App\Http\Controllers\KTTController;
use App\Http\Controllers\ProduksiController;
use App\Http\Controllers\RawInventoriController;
use App\Http\Controllers\SumberdayaController;
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
// Route::get('/iup/search', [IUPController::class, 'search'])->name('iup.search');

// Route::get('export', [ExportController::class, 'export'])->name('export.all');

Route::resource('jamrek', JamrekController::class);

Route::resource('jampas', JampasController::class);

Route::resource('komoditas', KomoditasController::class);

Route::resource('kabupaten', KabupatenController::class);

Route::resource('sumberdaya', SumberdayaController::class);

Route::resource('cadangan', CadanganController::class);

Route::resource('produksi', ProduksiController::class);

Route::resource('rawInventori', RawInventoriController::class);

Route::resource('ktt', KTTController::class);


Route::get('/sidebar', function () {
    return view('sidebar');
});

Route::get('/search', [IUPController::class, 'search']);

Route::get('/export', [IUPController::class, 'export'])->name('iup.export');




