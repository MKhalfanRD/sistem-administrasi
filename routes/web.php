<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\AdminCadanganController;
use App\Http\Controllers\admin\AdminIUPController;
use App\Http\Controllers\admin\AdminJampasController;
use App\Http\Controllers\admin\AdminJamrekController;
use App\Http\Controllers\admin\AdminKabupatenController;
use App\Http\Controllers\admin\AdminKomoditasController;
use App\Http\Controllers\admin\AdminKttController;
use App\Http\Controllers\admin\AdminProduksiController;
use App\Http\Controllers\admin\AdminRawInventoryController;
use App\Http\Controllers\admin\AdminSumberdayaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\user\UserCadanganController;
use App\Http\Controllers\user\UserController;
use App\Http\Controllers\user\UserIUPController;
use App\Http\Controllers\user\UserJampasController;
use App\Http\Controllers\user\UserJamrekController;
use App\Http\Controllers\user\UserKttController;
use App\Http\Controllers\user\UserProduksiController;
use App\Http\Controllers\user\UserRawInventoryController;
use App\Http\Controllers\user\UserSumberdayaController;
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
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Route::get('/iup/search', [IUPController::class, 'search'])->name('iup.search');

    // Route::get('export', [ExportController::class, 'export'])->name('export.all');
    Route::get('/sidebar', function () {
        return view('sidebar');
    });
});

Route::middleware('admin')->group(function () {
    Route::resource('admin', AdminController::class);
    Route::resource('admin/iup', AdminIUPController::class);
    Route::resource('admin/cadangan', AdminCadanganController::class);
    Route::resource('admin/jampas', AdminJampasController::class);
    Route::resource('admin/jamrek', AdminJamrekController::class);
    Route::resource('admin/kabupaten', AdminKabupatenController::class);
    Route::resource('admin/komoditas', AdminKomoditasController::class);
    Route::resource('admin/ktt', AdminKttController::class);
    Route::resource('admin/produksi', AdminProduksiController::class);
    Route::resource('admin/rawInventory', AdminRawInventoryController::class);
    Route::resource('admin/sumberdaya', AdminSumberdayaController::class);

    Route::get('admin/search', [AdminIUPController::class, 'search']);

    Route::get('admin/export', [AdminIUPController::class, 'export'])->name('admin.iup.export');

    Route::get('admin/wiup', [AdminIUPController::class, 'wiup'])->name('admin.wiup.index');
    Route::get('admin/wiup/create', [AdminIUPController::class, 'wiupCreate'])->name('admin.wiup.create');
    Route::post('admin/wiup', [AdminIUPController::class, 'wiupStore'])->name('admin.wiup.store');
    Route::get('admin/wiup/{id}/edit', [AdminIUPController::class, 'wiupEdit'])->name('admin.wiup.edit');
    Route::put('admin/wiup/{id}/edit', [AdminIUPController::class, 'wiupUpdate'])->name('admin.wiup.update');
    Route::delete('admin/wiup/{id}', [AdminIUPController::class, 'wiupDestroy'])->name('admin.wiup.destroy');

    Route::get('admin/eksplor', [AdminIUPController::class, 'eksplor'])->name('admin.eksplor.index');
    Route::get('admin/eksplor/create', [AdminIUPController::class, 'eksplorCreate'])->name('admin.eksplor.create');
    Route::post('admin/eksplor', [AdminIUPController::class, 'eksplorStore'])->name('admin.eksplor.store');
    Route::get('admin/eksplor/{id}/edit', [AdminIUPController::class, 'eksplorEdit'])->name('admin.eksplor.edit');
    Route::put('admin/eksplor/{id}/edit', [AdminIUPController::class, 'eksplorUpdate'])->name('admin.eksplor.update');
    Route::delete('admin/eksplor/{id}', [AdminIUPController::class, 'eksplorDestroy'])->name('admin.eksplor.destroy');

    Route::get('admin/op', [AdminIUPController::class, 'op'])->name('admin.op.index');
    Route::get('admin/op/create', [AdminIUPController::class, 'opCreate'])->name('admin.op.create');
    Route::post('admin/op', [AdminIUPController::class, 'opStore'])->name('admin.op.store');
    Route::get('admin/op/{id}/edit', [AdminIUPController::class, 'opEdit'])->name('admin.op.edit');
    Route::put('admin/op/{id}/edit', [AdminIUPController::class, 'opUpdate'])->name('admin.op.update');
    Route::delete('admin/op/{id}', [AdminIUPController::class, 'opDestroy'])->name('admin.op.destroy');

    Route::get('admin/p1', [AdminIUPController::class, 'p1'])->name('admin.p1.index');
    Route::get('admin/p1/create', [AdminIUPController::class, 'p1Create'])->name('admin.p1.create');
    Route::post('admin/p1', [AdminIUPController::class, 'p1Store'])->name('admin.p1.store');
    Route::get('admin/p1/{id}/edit', [AdminIUPController::class, 'p1Edit'])->name('admin.p1.edit');
    Route::put('admin/p1/{id}/edit', [AdminIUPController::class, 'p1Update'])->name('admin.p1.update');
    Route::delete('admin/p1/{id}', [AdminIUPController::class, 'p1Destroy'])->name('admin.p1.destroy');

    Route::get('admin/p2', [AdminIUPController::class, 'p2'])->name('admin.p2.index');
    Route::get('admin/p2/create', [AdminIUPController::class, 'p2Create'])->name('admin.p2.create');
    Route::post('admin/p2', [AdminIUPController::class, 'p2Store'])->name('admin.p2.store');
    Route::get('admin/p2/{id}/edit', [AdminIUPController::class, 'p2Edit'])->name('admin.p2.edit');
    Route::put('admin/p2/{id}/edit', [AdminIUPController::class, 'p2Update'])->name('admin.p2.update');
    Route::delete('admin/p2/{id}', [AdminIUPController::class, 'p2Destroy'])->name('admin.p2.destroy');
});
Route::middleware('user')->group(function () {
    Route::resource('user', UserController::class);
    Route::resource('user/iup', UserIUPController::class);
    Route::resource('user/jamrek', UserJamrekController::class);
    Route::resource('user/jampas', UserJampasController::class);
    Route::resource('user/sumberdaya', UserSumberdayaController::class);
    Route::resource('user/cadangan', UserCadanganController::class);
    Route::resource('user/produksi', UserProduksiController::class);
    Route::resource('user/rawInventori', UserRawInventoryController::class);
    Route::resource('user/ktt', UserKttController::class);

    Route::get('user/export', [UserIUPController::class, 'export'])->name('user.iup.export');

    Route::get('user/wiup', [UserIUPController::class, 'wiup'])->name('user.wiup.index');

    Route::get('user/eksplor', [AdminIUPController::class, 'eksplor'])->name('user.eksplor.index');

    Route::get('user/op', [UserIUPController::class, 'op'])->name('user.op.index');

    Route::get('user/p1', [UserIUPController::class, 'p1'])->name('user.p1.index');

    Route::get('user/p2', [UserIUPController::class, 'p2'])->name('user.p2.index');
});


require __DIR__.'/auth.php';


