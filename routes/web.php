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

Route::get('/wiup', [IUPController::class, 'wiup'])->name('wiup.index');
Route::get('/wiup/create', [IUPController::class, 'wiupCreate'])->name('wiup.create');
Route::post('/wiup', [IUPController::class, 'wiupStore'])->name('wiup.store');
Route::get('/wiup/{id}/edit', [IUPController::class, 'wiupEdit'])->name('wiup.edit');
Route::put('/wiup/{id}/edit', [IUPController::class, 'wiupUpdate'])->name('wiup.update');
Route::delete('/wiup/{id}', [IUPController::class, 'wiupDestroy'])->name('wiup.destroy');

Route::get('/eksplor', [IUPController::class, 'eksplor'])->name('eksplor.index');
Route::get('/eksplor/create', [IUPController::class, 'eksplorCreate'])->name('eksplor.create');
Route::post('/eksplor', [IUPController::class, 'eksplorStore'])->name('eksplor.store');
Route::get('/eksplor/{id}/edit', [IUPController::class, 'eksplorEdit'])->name('eksplor.edit');
Route::put('/eksplor/{id}/edit', [IUPController::class, 'eksplorUpdate'])->name('eksplor.update');
Route::delete('/eksplor/{id}', [IUPController::class, 'eksplorDestroy'])->name('eksplor.destroy');

Route::get('/op', [IUPController::class, 'op'])->name('op.index');
Route::get('/op/create', [IUPController::class, 'opCreate'])->name('op.create');
Route::post('/op', [IUPController::class, 'opStore'])->name('op.store');
Route::get('/op/{id}/edit', [IUPController::class, 'opEdit'])->name('op.edit');
Route::put('/op/{id}/edit', [IUPController::class, 'opUpdate'])->name('op.update');
Route::delete('/op/{id}', [IUPController::class, 'opDestroy'])->name('op.destroy');

Route::get('/p1', [IUPController::class, 'p1'])->name('p1.index');
Route::get('/p1/create', [IUPController::class, 'p1Create'])->name('p1.create');
Route::post('/p1', [IUPController::class, 'p1Store'])->name('p1.store');
Route::get('/p1/{id}/edit', [IUPController::class, 'p1Edit'])->name('p1.edit');
Route::put('/p1/{id}/edit', [IUPController::class, 'p1Update'])->name('p1.update');
Route::delete('/p1/{id}', [IUPController::class, 'p1Destroy'])->name('p1.destroy');

Route::get('/p2', [IUPController::class, 'p2'])->name('p2.index');
Route::get('/p2/create', [IUPController::class, 'p2Create'])->name('p2.create');
Route::post('/p2', [IUPController::class, 'p2Store'])->name('p2.store');
Route::get('/p2/{id}/edit', [IUPController::class, 'p2Edit'])->name('p2.edit');
Route::put('/p2/{id}/edit', [IUPController::class, 'p2Update'])->name('p2.update');
Route::delete('/p2/{id}', [IUPController::class, 'p2Destroy'])->name('p2.destroy');

