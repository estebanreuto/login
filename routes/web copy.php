<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CsvController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard principal
    Route::get('/dashboard', [CsvController::class, 'index'])->name('dashboard');

    // CSV CRUD Routes
    Route::post('/csv-upload', [CsvController::class, 'upload'])->name('csv.upload');
    Route::post('/csv-create', [CsvController::class, 'store'])->name('csv.store');
    Route::post('/csv-update', [CsvController::class, 'update'])->name('csv.update');
    Route::delete('/csv-delete/{id}', [CsvController::class, 'delete'])->name('csv.delete');

    // Descargar CSV
    Route::get('/csv-download', [CsvController::class, 'download'])->name('csv.download');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
