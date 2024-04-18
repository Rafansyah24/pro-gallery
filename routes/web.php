<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UploadController;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Profiler\Profile;

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

Route::group(['middleware' => 'auth'], function(){
    Route::get('/home', [HomeController::class, 'index_home'])->name('home');
});

Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/loginPost', [AuthController::class, 'loginStore'])->name('loginPost');

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registerStore'])->name('registerPost');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/profile', [ProfileController::class, 'index_profile'])->name('profile');
Route::put('/updateprofile', [ProfileController::class, 'updateProfile'])->name('updateProfile');
Route::get('/editprofile', [ProfileController::class, 'editProfile'])->name('editProfile');


Route::get('/album',[AlbumController::class,'index_create'])->name('album');
Route::post('/albumcreate',[AlbumController::class,'create_album'])->name('createAlbum');
Route::delete('/albums/{id}', [AlbumController::class, 'hapus_album'])->name('hapusAlbum');
Route::get('/detailalbum/{id}', [ProfileController::class,'show_album'])->name('detailalbum');
Route::delete('/photos/{id}', [ProfileController::class, 'deletePhoto'])->name('deletePhoto');
Route::get('/profile/{id}', [ProfileController::class, 'showProfile'])->name('profile.profile');



Route::get('/upload', [UploadController::class, 'index_upload'])->name('upload');
Route::post('/uploadFoto', [UploadController::class, 'uploadFoto'])->name('uploadFoto');


Route::get('/detailfoto/{id}', [HomeController::class, 'show_foto'])->name('showFoto');
Route::post('/komentarfoto', [HomeController::class, 'storeKomentar'])->name('storeKomentar');

Route::post('/like', [HomeController::class, 'like'])->name('like');


//export album
Route::get('export-albums', [AlbumController::class, 'exportAlbumToExcel'])->name('exportAlbumToExcel');