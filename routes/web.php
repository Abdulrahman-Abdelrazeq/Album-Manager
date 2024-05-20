<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\PhotoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('albums.index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('/albums', AlbumController::class)->names('albums');

    Route::post('albums/{album}/delete-photos', [AlbumController::class, 'deleteAllPhotos'])->name('albums.deleteAllPhotos');
    Route::post('albums/{album}/move-photos', [AlbumController::class, 'movePhotos'])->name('albums.movePhotos');
    
    Route::resource('albums.photos', PhotoController::class);

});

require __DIR__.'/auth.php';
