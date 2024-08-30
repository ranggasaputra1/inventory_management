<?php





use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PengadaanController;
use App\Http\Controllers\DataBarangController;
use App\Http\Controllers\DataRuanganController;
use App\Http\Controllers\DataPeminjamanController;

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
    return redirect()->route('login');
});

// Route Halaman Login
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);


// Route Halaman Dashboard
Route::get('/dashboard', function(){
    return view('dashboard.index', [
        "tittle" => "Dashboard",
        "active_menu" => "dashboard"
    ]);
})->middleware('auth');


// Route Halaman Data Ruangan
Route::middleware('auth')->group(function () {
    // Route Halaman Data Ruangan
    Route::get('/ruangan', [DataRuanganController::class, 'index'])->name('ruangan.index');
    Route::get('/ruangan/create', [DataRuanganController::class, 'create'])->name('ruangan.create');
    Route::post('/ruangan', [DataRuanganController::class, 'store'])->name('ruangan.store');
    Route::get('ruangan/{id}', [DataRuanganController::class, 'show'])->name('ruangan.show');
    Route::get('ruangan/{id}/edit', [DataRuanganController::class, 'edit'])->name('ruangan.edit');
    Route::put('ruangan/{id}', [DataRuanganController::class, 'update'])->name('ruangan.update');
    Route::delete('ruangan/{id}', [DataRuanganController::class, 'destroy'])->name('ruangan.destroy');
    Route::get('ruangan/print/{sort_by}', [DataRuanganController::class, 'print'])->name('ruangan.print');
});

// Route Halaman Data Barang
Route::middleware('auth')->group(function () {
    // Route Halaman Data Barang
    Route::get('/barang', [DataBarangController::class, 'index'])->name('barang.index');
    Route::get('/barang/create', [DataBarangController::class, 'create'])->name('barang.create');
    Route::post('/barang', [DataBarangController::class, 'store'])->name('barang.store');
    Route::get('barang/{id}', [DataBarangController::class, 'show'])->name('barang.show');
    Route::get('barang/{id}/edit', [DataBarangController::class, 'edit'])->name('barang.edit');
    Route::put('barang/{id}', [DataBarangController::class, 'update'])->name('barang.update');
    Route::delete('barang/{id}', [DataBarangController::class, 'destroy'])->name('barang.destroy');
    Route::get('barang/print/{sort_by}', [DataBarangController::class, 'print'])->name('barang.print');
});

// Route Halaman Pengadaan
Route::middleware('auth')->group(function () {
    // Route Halaman Pengadaan
    Route::get('/pengadaan', [PengadaanController::class, 'index'])->name('pengadaan.index');
    Route::get('/pengadaan/create', [PengadaanController::class, 'create'])->name('pengadaan.create');
    Route::post('/pengadaan', [PengadaanController::class, 'store'])->name('pengadaan.store');
    Route::get('pengadaan/{id}', [PengadaanController::class, 'show'])->name('pengadaan.show');
    Route::get('pengadaan/{id}/edit', [PengadaanController::class, 'edit'])->name('pengadaan.edit');
    Route::put('pengadaan/{id}', [PengadaanController::class, 'update'])->name('pengadaan.update');
    Route::delete('pengadaan/{id}', [PengadaanController::class, 'destroy'])->name('pengadaan.destroy');
    Route::get('pengadaan/print/{sort_by}', [PengadaanController::class, 'print'])->name('pengadaan.print');
});

// Route Halaman Peminjaman
Route::middleware('auth')->group(function () {
    // Route Halaman Peminjaman
    Route::get('/peminjaman', [DataPeminjamanController::class, 'index'])->name('peminjaman.index');
    Route::get('/peminjaman/create', [DataPeminjamanController::class, 'create'])->name('peminjaman.create');
    Route::post('/peminjaman', [DataPeminjamanController::class, 'store'])->name('peminjaman.store');
    Route::get('peminjaman/{id}', [DataPeminjamanController::class, 'show'])->name('peminjaman.show');
    Route::get('peminjaman/{id}/edit', [DataPeminjamanController::class, 'edit'])->name('peminjaman.edit');
    Route::put('peminjaman/{id}', [DataPeminjamanController::class, 'update'])->name('peminjaman.update');
    Route::delete('peminjaman/{id}', [DataPeminjamanController::class, 'destroy'])->name('peminjaman.destroy');
    Route::get('peminjaman/print/{sort_by}', [DataPeminjamanController::class, 'print'])->name('peminjaman.print');
    Route::get('/peminjaman/history/data', [DataPeminjamanController::class, 'history'])->name('peminjaman.history');
    Route::get('/peminjaman/history/print/{sort_by}', [DataPeminjamanController::class, 'printHistory'])->name('peminjaman.history.print');

});

// Route Menu Profile
Route::middleware('auth')->group(function () {
    // Route Halaman Pengadaan
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// Route Menu Profile
Route::middleware('auth')->group(function () {
// Route untuk halaman tambah akun
    Route::get('/add-account', [AccountController::class, 'create'])->name('add-account');
    Route::post('/add-account', [AccountController::class, 'store']);
});