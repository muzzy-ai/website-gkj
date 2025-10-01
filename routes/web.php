<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{
  RenunganController, WartaController, BeritaController, AgendaItemController,
  InformasiController, LayananJemaatController, HalamanController,
  AlbumController, PhotoController
};
use App\Http\Controllers\SiteController;


// Beranda
Route::view('/', 'TampilanUtama.beranda')->name('beranda');

// Halaman publik (dummy untuk sekarang)
Route::view('/renungan',           'TampilanUtama.renungan')->name('renungan.index');
Route::view('/warta',              'TampilanUtama.wartajemaat')->name('warta.index');
Route::view('/berita',             'TampilanUtama.berita')->name('berita.index');
Route::view('/agenda',             'TampilanUtama.agenda')->name('agenda.index');
Route::view('/foto',               'TampilanUtama.foto')->name('foto.index');
Route::view('/informasi',          'TampilanUtama.informasi')->name('informasi.index');
Route::view('/tentang-kami',       'TampilanUtama.tentang')->name('tentang');
Route::view('/layanan-jemaat',     'TampilanUtama.layanan')->name('layanan');

// Contoh route “show” dummy untuk link pada daftar (optional)
Route::get('/informasi/{id}', fn($id)=>"Informasi #$id")->name('informasi.show');
Route::get('/agenda/{id}',    fn($id)=>"Agenda #$id")->name('agenda.show');
Route::get('/foto/{id}',      fn($id)=>"Foto #$id")->name('foto.show');


Route::get('/', [SiteController::class,'home'])->name('home');

Route::middleware(['auth','role:admin,publisher,editor'])
  ->prefix('admin')->name('admin.')->group(function(){
    Route::view('/','admin.dashboard')->name('dashboard');
    Route::resource('renungans', RenunganController::class);
    Route::resource('wartas', WartaController::class);
    Route::resource('beritas', BeritaController::class);
    Route::resource('agenda-items', AgendaItemController::class);
    Route::resource('informasi-pentings', InformasiController::class);
    Route::resource('layanan-jemaats', LayananJemaatController::class);
    Route::resource('halamans', HalamanController::class);
    Route::resource('albums', AlbumController::class);
    Route::resource('photos', PhotoController::class)->only(['index','create','store','destroy']);
});
require __DIR__.'/auth.php';