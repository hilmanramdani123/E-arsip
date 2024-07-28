<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\EditController;
use App\Http\Controllers\DeleteController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SearchController;

Route::get('/', function () {
    return view('auth.login');
})->middleware('guest');

Auth::routes(['register' => false, 'reset' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/autologin/{username}', function ($username) {
    $user = \App\Models\User::where('username', $username)->first();
    if ($user) {
        Auth::login($user);
        return redirect('/home');
    } else {
        return redirect('/')->with('error', 'User dengan username tersebut tidak ditemukan.');
    }
})->middleware('guest');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/arsip', [UploadController::class, 'index'])->name('dokumen.index');
    Route::get('/upload', [UploadController::class, 'create'])->name('upload.create');
    Route::post('/upload', [UploadController::class, 'store'])->name('upload.store');
    Route::get('dokumen/{id}/edit', [EditController::class, 'edit'])->name('dokumen.edit');
    Route::put('dokumen/{id}', [EditController::class, 'update'])->name('dokumen.update');
    Route::delete('/dokumen/{id}', [DeleteController::class, 'destroy'])->name('dokumen.destroy');

    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
    Route::get('/kategori/{kategori}', [KategoriController::class, 'show'])->name('kategori.show');
    Route::get('/kategori/{kategori}/edit/{id}', [KategoriController::class, 'edit'])->name('kategori.edit');
    Route::post('/kategori/{kategori}/update/{id}', [KategoriController::class, 'update'])->name('kategori.update');
});

