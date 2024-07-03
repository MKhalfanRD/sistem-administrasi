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
use App\Http\Controllers\admin\AdminStokProdukController;
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
use App\Http\Controllers\user\UserStokProdukController;
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

use App\Services\TwilioService;

Route::get('/test-whatsapp', function (App\Services\TwilioService $twilioService) {
    $to = '+6287851603755'; // Ganti dengan nomor WhatsApp Anda yang telah bergabung dengan sandbox
    $message = 'Test message from Twilio';

    $twilioService->sendWhatsAppMessage($to, $message);
});




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

Route::middleware(['auth','admin'])->group(function () {
    // Route::resource('admin', AdminController::class);
    // Route::resource('admin/iup', AdminIUPController::class);
    // Route::get('admin/data-iup', [AdminIUPController::class, 'index'])->name('admin.iup');
    // Route::resource('admin/cadangan', AdminCadanganController::class);
    // Route::resource('admin/jampas', AdminJampasController::class);
    // Route::resource('admin/jamrek', AdminJamrekController::class);
    // Route::resource('admin/kabupaten', AdminKabupatenController::class);
    // Route::resource('admin/komoditas', AdminKomoditasController::class);
    // Route::resource('admin/ktt', AdminKttController::class);
    // Route::resource('admin/produksi', AdminProduksiController::class);
    // Route::resource('admin/rawInventory', AdminRawInventoryController::class);
    // Route::resource('admin/sumberdaya', AdminSumberdayaController::class);

    Route::get('/admin/iup/search', [AdminIUPController::class, 'IupSearch'])->name('iup.search');
    Route::get('/admin/wiup/search', [AdminIUPController::class, 'WIupSearch'])->name('wiup.search');
    Route::get('/admin/eksplor/search', [AdminIUPController::class, 'EksplorSearch'])->name('eksplor.search');
    Route::get('/admin/op/search', [AdminIUPController::class, 'OpSearch'])->name('op.search');
    Route::get('/admin/p1/search', [AdminIUPController::class, 'P1Search'])->name('p1.search');
    Route::get('/admin/p2/search', [AdminIUPController::class, 'p2Search'])->name('p2.search');

    Route::get('admin/export-iup', [AdminIUPController::class, 'IupExport'])->name('admin.iup.export');
    Route::get('admin/export-wiup', [AdminIUPController::class, 'WiupExport'])->name('admin.wiup.export');
    Route::get('admin/export-eksplor', [AdminIUPController::class, 'EksplorExport'])->name('admin.eksplor.export');
    Route::get('admin/export-op', [AdminIUPController::class, 'OpExport'])->name('admin.op.export');
    Route::get('admin/export-p1', [AdminIUPController::class, 'P1Export'])->name('admin.p1.export');
    Route::get('admin/export-p2', [AdminIUPController::class, 'P2Export'])->name('admin.p2.export');

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

    Route::get('admin', [AdminController::class, 'index'])->name('admin.index');
    Route::post('admin', [AdminController::class, 'store'])->name('admin.store');
    Route::get('admin/create', [AdminController::class, 'create'])->name('admin.create');
    Route::put('admin/{admin}', [AdminController::class, 'update'])->name('admin.update');
    Route::get('admin/{admin}/edit', [AdminController::class, 'edit'])->name('admin.edit');
    Route::delete('admin/{admin}', [AdminController::class, 'destroy'])->name('admin.destroy');

    Route::get('admin/iup', [AdminIUPController::class, 'index'])->name('admin.iup.index');
    Route::post('admin/iup', [AdminIUPController::class, 'store'])->name('admin.iup.store');
    Route::get('admin/iup/create', [AdminIUPController::class, 'create'])->name('admin.iup.create');
    Route::put('admin/iup/{iup}', [AdminIUPController::class, 'update'])->name('admin.iup.update');
    Route::get('admin/iup/{iup}/edit', [AdminIUPController::class, 'edit'])->name('admin.iup.edit');
    Route::delete('admin/iup/{iup}', [AdminIUPController::class, 'destroy'])->name('admin.iup.destroy');

    Route::get('/getKomoditas/{golongan}', [AdminIUPController::class, 'getKomoditas'])->name('admin.iup.komoditas');

    Route::get('admin/cadangan', [AdminCadanganController::class, 'index'])->name('admin.cadangan.index');
    Route::post('admin/cadangan', [AdminCadanganController::class, 'store'])->name('admin.cadangan.store');
    Route::get('admin/cadangan/create', [AdminCadanganController::class, 'create'])->name('admin.cadangan.create');
    Route::put('admin/cadangan/{cadangan}', [AdminCadanganController::class, 'update'])->name('admin.cadangan.update');
    Route::get('admin/cadangan/{cadangan}/edit', [AdminCadanganController::class, 'edit'])->name('admin.cadangan.edit');
    Route::delete('admin/cadangan/{cadangan}', [AdminCadanganController::class, 'destroy'])->name('admin.cadangan.destroy');

    Route::get('/getKomoditas/{golongan}', [AdminCadanganController::class, 'getKomoditas'])->name('admin.cadangan.komoditas');

    Route::get('admin/jampas', [AdminJampasController::class, 'index'])->name('admin.jampas.index');
    Route::post('admin/jampas', [AdminJampasController::class, 'store'])->name('admin.jampas.store');
    Route::get('admin/jampas/create', [AdminJampasController::class, 'create'])->name('admin.jampas.create');
    Route::put('admin/jampas/{jampas}', [AdminJampasController::class, 'update'])->name('admin.jampas.update');
    Route::get('admin/jampas/{jampas}/edit', [AdminJampasController::class, 'edit'])->name('admin.jampas.edit');
    Route::delete('admin/jampas/{jampas}', [AdminJampasController::class, 'destroy'])->name('admin.jampas.destroy');

    Route::get('admin/jamrek', [AdminJamrekController::class, 'index'])->name('admin.jamrek.index');
    Route::post('admin/jamrek', [AdminJamrekController::class, 'store'])->name('admin.jamrek.store');
    Route::get('admin/jamrek/create', [AdminJamrekController::class, 'create'])->name('admin.jamrek.create');
    Route::put('admin/jamrek/{jamrek}', [AdminJamrekController::class, 'update'])->name('admin.jamrek.update');
    Route::get('admin/jamrek/{jamrek}/edit', [AdminJamrekController::class, 'edit'])->name('admin.jamrek.edit');
    Route::delete('admin/jamrek/{jamrek}', [AdminJamrekController::class, 'destroy'])->name('admin.jamrek.destroy');

    Route::get('admin/kabupaten', [AdminKabupatenController::class, 'index'])->name('admin.kabupaten.index');
    Route::post('admin/kabupaten', [AdminKabupatenController::class, 'store'])->name('admin.kabupaten.store');
    Route::get('admin/kabupaten/create', [AdminKabupatenController::class, 'create'])->name('admin.kabupaten.create');
    Route::put('admin/kabupaten/{kabupaten}', [AdminKabupatenController::class, 'update'])->name('admin.kabupaten.update');
    Route::get('admin/kabupaten/{kabupaten}/edit', [AdminKabupatenController::class, 'edit'])->name('admin.kabupaten.edit');
    Route::delete('admin/kabupaten/{kabupaten}', [AdminKabupatenController::class, 'destroy'])->name('admin.kabupaten.destroy');

    Route::get('admin/komoditas', [AdminKomoditasController::class, 'index'])->name('admin.komoditas.index');
    Route::post('admin/komoditas', [AdminKomoditasController::class, 'store'])->name('admin.komoditas.store');
    Route::get('admin/komoditas/create', [AdminKomoditasController::class, 'create'])->name('admin.komoditas.create');
    Route::put('admin/komoditas/{komoditas}', [AdminKomoditasController::class, 'update'])->name('admin.komoditas.update');
    Route::get('admin/komoditas/{komoditas}/edit', [AdminKomoditasController::class, 'edit'])->name('admin.komoditas.edit');
    Route::delete('admin/komoditas/{komoditas}', [AdminKomoditasController::class, 'destroy'])->name('admin.komoditas.destroy');

    Route::get('admin/ktt', [AdminKttController::class, 'index'])->name('admin.ktt.index');
    Route::post('admin/ktt', [AdminKttController::class, 'store'])->name('admin.ktt.store');
    Route::get('admin/ktt/create', [AdminKttController::class, 'create'])->name('admin.ktt.create');
    Route::put('admin/ktt/{ktt}', [AdminKttController::class, 'update'])->name('admin.ktt.update');
    Route::get('admin/ktt/{ktt}/edit', [AdminKttController::class, 'edit'])->name('admin.ktt.edit');
    Route::delete('admin/ktt/{ktt}', [AdminKttController::class, 'destroy'])->name('admin.ktt.destroy');

    Route::get('admin/produksi', [AdminProduksiController::class, 'index'])->name('admin.produksi.index');
    Route::post('admin/produksi', [AdminProduksiController::class, 'store'])->name('admin.produksi.store');
    Route::get('admin/produksi/create', [AdminProduksiController::class, 'create'])->name('admin.produksi.create');
    Route::put('admin/produksi/{produksi}', [AdminProduksiController::class, 'update'])->name('admin.produksi.update');
    Route::get('admin/produksi/{produksi}/edit', [AdminProduksiController::class, 'edit'])->name('admin.produksi.edit');
    Route::delete('admin/produksi/{produksi}', [AdminProduksiController::class, 'destroy'])->name('admin.produksi.destroy');

    Route::get('/getKomoditas/{golongan}', [AdminProduksiController::class, 'getKomoditas'])->name('admin.produksi.komoditas');

    Route::get('admin/rawInventory', [AdminRawInventoryController::class, 'index'])->name('admin.rawInventory.index');
    Route::post('admin/rawInventory', [AdminRawInventoryController::class, 'store'])->name('admin.rawInventory.store');
    Route::get('admin/rawInventory/create', [AdminRawInventoryController::class, 'create'])->name('admin.rawInventory.create');
    Route::put('admin/rawInventory/{rawInventory}', [AdminRawInventoryController::class, 'update'])->name('admin.rawInventory.update');
    Route::get('admin/rawInventory/{rawInventory}/edit', [AdminRawInventoryController::class, 'edit'])->name('admin.rawInventory.edit');
    Route::delete('admin/rawInventory/{rawInventory}', [AdminRawInventoryController::class, 'destroy'])->name('admin.rawInventory.destroy');

    Route::get('admin/sumberdaya', [AdminSumberdayaController::class, 'index'])->name('admin.sumberdaya.index');
    Route::post('admin/sumberdaya', [AdminSumberdayaController::class, 'store'])->name('admin.sumberdaya.store');
    Route::get('admin/sumberdaya/create', [AdminSumberdayaController::class, 'create'])->name('admin.sumberdaya.create');
    Route::put('admin/sumberdaya/{sumberdaya}', [AdminSumberdayaController::class, 'update'])->name('admin.sumberdaya.update');
    Route::get('admin/sumberdaya/{sumberdaya}/edit', [AdminSumberdayaController::class, 'edit'])->name('admin.sumberdaya.edit');
    Route::delete('admin/sumberdaya/{sumberdaya}', [AdminSumberdayaController::class, 'destroy'])->name('admin.sumberdaya.destroy');

    Route::get('/getKomoditas/{golongan}', [AdminSumberdayaController::class, 'getKomoditas'])->name('admin.sumberdaya.komoditas');

    Route::get('admin/stokProduk', [AdminStokProdukController::class, 'index'])->name('admin.stokProduk.index');
    Route::post('admin/stokProduk', [AdminStokProdukController::class, 'store'])->name('admin.stokProduk.store');
    Route::get('admin/stokProduk/create', [AdminStokProdukController::class, 'create'])->name('admin.stokProduk.create');
    Route::put('admin/stokProduk/{stokProduk}', [AdminStokProdukController::class, 'update'])->name('admin.stokProduk.update');
    Route::get('admin/stokProduk/{stokProduk}/edit', [AdminStokProdukController::class, 'edit'])->name('admin.stokProduk.edit');
    Route::delete('admin/stokProduk/{stokProduk}', [AdminStokProdukController::class, 'destroy'])->name('admin.stokProduk.destroy');
});


    Route::get('user', [UserController::class, 'index'])->name('user.index');
    Route::post('user', [UserController::class, 'store'])->name('user.store');
    Route::get('user/create', [UserController::class, 'create'])->name('user.create');
    Route::put('user/{user}', [UserController::class, 'update'])->name('user.update');
    Route::get('user/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::delete('user/{user}', [UserController::class, 'destroy'])->name('user.destroy');

    Route::get('user/iup', [UserIUPController::class, 'index'])->name('user.iup.index');

    Route::get('user/jamrek', [UserJamrekController::class, 'index'])->name('user.jamrek.index');

    Route::get('user/jampas', [UserJampasController::class, 'index'])->name('user.jampas.index');

    Route::get('user/sumberdaya', [UserSumberdayaController::class, 'index'])->name('user.sumberdaya.index');

    Route::get('user/cadangan', [UserCadanganController::class, 'index'])->name('user.cadangan.index');

    Route::get('user/produksi', [UserProduksiController::class, 'index'])->name('user.produksi.index');
    Route::get('user/produksi/{produksi}/edit', [UserProduksiController::class, 'edit'])->name('user.produksi.edit');
    Route::put('user/produksi/{produksi}', [UserProduksiController::class, 'update'])->name('user.produksi.update');

    Route::get('/getKomoditas/{golongan}', [AdminProduksiController::class, 'getKomoditas'])->name('user.produksi.komoditas');


    Route::get('user/rawInventori', [UserRawInventoryController::class, 'index'])->name('user.rawInventori.index');
    Route::get('user/rawInventori/{rawInventori}/edit', [UserRawInventoryController::class, 'edit'])->name('user.rawInventori.edit');
    Route::put('user/rawInventori/{rawInventori}', [UserRawInventoryController::class, 'update'])->name('user.rawInventori.update');

    Route::get('user/stokProduk', [UserStokProdukController::class, 'index'])->name('user.stokProduk.index');
    Route::get('user/stokProduk/{stokProduk}/edit', [UserStokProdukController::class, 'edit'])->name('user.stokProduk.edit');
    Route::put('user/stokProduk/{stokProduk}', [UserStokProdukController::class, 'update'])->name('user.stokProduk.update');

    Route::get('user/ktt', [UserKttController::class, 'index'])->name('user.ktt.index');

    Route::get('user/wiup', [UserIUPController::class, 'wiup'])->name('user.wiup.index');

    Route::get('user/eksplor', [UserIUPController::class, 'eksplor'])->name('user.eksplor.index');

    Route::get('user/op', [UserIUPController::class, 'op'])->name('user.op.index');

    Route::get('user/p1', [UserIUPController::class, 'p1'])->name('user.p1.index');

    Route::get('user/p2', [UserIUPController::class, 'p2'])->name('user.p2.index');


require __DIR__.'/auth.php';


