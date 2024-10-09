<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChirpController;
use App\Http\Controllers\ProfileController;


// DB::listen(function ($query){
//     dump($query->sql);
// });

Route::get('/', function () {
    return view('welcome');
});

// Route::view('/', '3')->name('welcome'); //Ruta simplificada



Route::get('/chirps', [ChirpController::class, 'index'])->middleware(['auth', 'verified'])->name('chirps.index'); //nombre de la ruta

Route::get('/mis-chirps/{id}', [ChirpController::class, 'show'])->middleware(['auth', 'verified'])->name('chirps.show');

Route::post('/chirps', [ChirpController::class, 'store'])->name('chirps.store');

Route::get('/chirps/{chirp}/edit', [ChirpController::class, 'edit'])->name('chirps.edit');

Route::put('/chirps/{chirp}', [ChirpController::class, 'update'])->name('chirps.update');

Route::delete('/chirps/{chirp}', [ChirpController::class, 'destroy'])->name('chirps.destroy');

// Route::get('/chirps/{chirp}', function ($chirp) {
//     if ($chirp = 2) {
//         return redirect()->route('chirps.index'); aqui redireccionamos a otra ruta
//     }else {
//         return 'Id del chirp';  
//     }
    
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
