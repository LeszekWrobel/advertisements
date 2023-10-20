<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdvertisementController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PhotoController;

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

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Dodaj ogłoszenie (formularz)
Route::get('/advertisements/create', [AdvertisementController::class, 'create'])->name('advertisements.create');
Route::post('/advertisements', [AdvertisementController::class, 'store'])->name('advertisements.store');

//Route::middleware(['auth'])->group(function () {
    Route::get('advertisements.index', [AdvertisementController::class, 'index'])->name('advertisements.index');
//});

//Route::delete('/advertisements/{advertisement}', 'AdvertisementController@destroy')->name('advertisements.destroy');
Route::delete('/advertisements/{advertisement}', [AdvertisementController::class, 'destroy'])->name('advertisements.destroy');

//Route::post('/ogloszenia/{advertisement}/aktualizuj-kolejnosc-zdjec', [AdvertisementController::class, 'updatePhotoOrder'])->name('update-photo-order');

Route::get('/advertisements/{id}/edit', [AdvertisementController::class, 'edit'])->name('advertisements.edit');
Route::put('/advertisements/{id}', [AdvertisementController::class, 'update'])->name('advertisements.update');
Route::get('/advertisements/{id}/show', [AdvertisementController::class, 'show'])->name('advertisements.show');

// routes/web.php
//Route::delete('/photos/{photo}', [PhotoController::class], 'destroy')->name('photo.destroy');

Route::delete('/advertisements/{id}/edit', [PhotoController::class], 'deleteFile')->name('photos.deleteFile');
//Route::delete('/photos/{id}', 'PhotoController@delete');

Route::post('/photos/rotate/{id}', 'PhotoController@rotate');
//Route::post('/upload', 'FileUploadController@upload')->name('upload');


//Route::post('/advertisements/{id}', [AdvertisementController::class, 'updatePhotoOrder'])->name('uploadFile');
//Route::post('/advertisements/{id}', [AdvertisementController::class, 'updatePhotoOrder'])->name('advertisements.updatePhotoOrder');
//Route::post('advertisements/{advertisement}/aktualizuj-kolejnosc-zdjec', 'AdvertisementController@updatePhotoOrder')->name('update-photo-order');
//Route::post('/advertisements/{id}', [FileController::class, 'update'])->name('uploadFile');
//Route::post('/upload-file', 'FileController@uploadFile')->name('uploadFile');
//Route::post('/upload', [FileUploadController::class, 'upload'])->name('upload');
//Route::post('/advertisements/upload-store', [FileUploadController::class, 'store'])->name('store');
//Route::get('/', [DropzoneController::class, 'index'])->name('index');
//Route::post('/uploadFile', [DropzoneController::class, 'uploadFile'])->name('uploadFile');


