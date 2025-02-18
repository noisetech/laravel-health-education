<?php

use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriArtikelControlller;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TagArtikelController;
use App\Http\Controllers\TanyaJawabController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VideoEdukasiController;
use Illuminate\Support\Facades\Auth;
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
    return view('welcome');
});


Route::prefix('internal')
->middleware('auth')
->group(function () {

    // video edukasi
    Route::get('video-edukasi', [VideoEdukasiController::class, 'index'])
        ->name('video_edukasi');
    Route::get('video-edukasi/tambah', [VideoEdukasiController::class, 'tambah'])
        ->name('video_edukasi.tambah');
    Route::post('video-edukasi/simpan', [VideoEdukasiController::class, 'simpan'])
        ->name('video_edukasi.simpan');
    Route::get('video-edukasi/edit/{id}', [VideoEdukasiController::class, 'edit'])
        ->name('video_edukasi.edit');
    Route::put('video-edukasi/update/{id}', [VideoEdukasiController::class, 'update'])
        ->name('video_edukasi.update');
    Route::get('video-edukasi/hapus/{id}', [VideoEdukasiController::class, 'hapus'])
        ->name('video_edukasi.hapus');


    // dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // permission
    Route::get('permissions', [PermissionController::class, 'index'])
        ->name('permissions');
    Route::get('permissions/tambah', [PermissionController::class, 'tambah'])
        ->name('permissions.tambah');
    Route::post('permissions/simpan', [PermissionController::class, 'simpan'])
        ->name('permissions.simpan');
    Route::get('permissions/edit/{id}', [PermissionController::class, 'edit'])
        ->name('permissions.edit');
    Route::put('permissions/update/{id}', [PermissionController::class, 'update'])
        ->name('permissions.update');
    Route::get('permissions/hapus/{id}', [PermissionController::class, 'hapus'])
        ->name('permissions.hapus');

    // tanya jawab
    Route::get('tanya-jawab', [TanyaJawabController::class, 'index'])
        ->name('tanya_jawab');

    Route::get('role', [RoleController::class, 'index'])
        ->name('role');
    Route::get('role/tambah', [RoleController::class, 'tambah'])
        ->name('role.tambah');
    Route::post('role/simpan', [RoleController::class, 'simpan'])
        ->name('role.simpan');
    Route::get('role/edit/{id}', [RoleController::class, 'edit'])
        ->name('role.edit');
    Route::put('role/update/{id}', [RoleController::class, 'update'])
        ->name('role.update');
    Route::get('role/hapus/{id}', [RoleController::class, 'hapus'])
        ->name('role.hapus');


    Route::get('user', [UserController::class, 'index'])
        ->name('user');
    Route::get('user/tambah', [UserController::class, 'tambah'])
        ->name('user.tambah');
    Route::post('user/simpan', [UserController::class, 'simpan'])
        ->name('user.simpan');
    Route::get('user/edit/{id}', [UserController::class, 'edit'])
        ->name('user.edit');
    Route::put('user/update/{id}', [UserController::class, 'update'])
        ->name('user.update');
    Route::get('user/hapus/{id}', [UserController::class, 'hapus'])
        ->name('user.hapus');


    // dokter

    // kategori artikel
    Route::get('/kategori-artikel', [KategoriArtikelControlller::class, 'index'])
        ->name('kategori-artikel');
    Route::get('/kategori-artikel/tambah', [KategoriArtikelControlller::class, 'tambah'])
        ->name('kategori-artikel.tambah');
    Route::post('/kategori-artikel/simpan', [KategoriArtikelControlller::class, 'simpan'])
        ->name('kategori-artikel.simpan');
    Route::get('/kategori-artikel/edit/{id}', [KategoriArtikelControlller::class, 'edit'])
        ->name('kategori-artikel.edit');
    Route::put('/kategori-artikel/update/{id}', [KategoriArtikelControlller::class, 'update'])
        ->name('kategori-artikel.update');
    Route::get('/kategori-artikel/hapus/{id}', [KategoriArtikelControlller::class, 'hapus'])
        ->name('kategori-artikel.hapus');


    // tag artikel
    Route::get('tag-artikel', [TagArtikelController::class, 'index'])
        ->name('tag-artikel');
    Route::get('tag-artikel/tambah', [TagArtikelController::class, 'tambah'])
        ->name('tag-artikel.tambah');
    Route::post('tag-artikel/simpan', [TagArtikelController::class, 'simpan'])
        ->name('tag-artikel.simpan');
    Route::get('tag-artikel/edit/{id}', [TagArtikelController::class, 'edit'])
        ->name('tag-artikel.edit');
    Route::put('tag-artikel/update/{id}', [TagArtikelController::class, 'update'])
        ->name('tag-artikel.update');
    Route::get('tag-artikel/hapus/{id}', [TagArtikelController::class, 'hapus'])
        ->name('tag-artikel.hapus');


    // artikel
    Route::get('artikel', [ArtikelController::class, 'index'])
        ->name('artikel');
    Route::get('artikel/tambah', [ArtikelController::class, 'tambah'])
        ->name('artikel.tambah');
    Route::post('artikel/simpan', [ArtikelController::class, 'simpan'])
        ->name('artikel.simpan');
    Route::get('artikel/edit/{id}', [ArtikelController::class, 'edit'])
        ->name('artikel.edit');
    Route::put('artikel/update/{id}', [ArtikelController::class, 'update'])
        ->name('artikel.update');
    Route::get('artikel/hapus/{id}', [ArtikelController::class, 'hapus'])
        ->name('artikel.hapus');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
