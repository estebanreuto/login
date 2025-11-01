<?php
use App\Http\Controllers\CsvController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UiPreferenceController;

Route::get('/', fn() => view('welcome'));

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', [CsvController::class, 'index'])->name('dashboard');
    Route::post('/csv-upload', [CsvController::class, 'upload'])->name('csv.upload');
    Route::post('/csv-create', [CsvController::class, 'store'])->name('csv.store');
    Route::post('/csv-update', [CsvController::class, 'update'])->name('csv.update');
    Route::delete('/csv-delete/{id}', [CsvController::class, 'delete'])->name('csv.delete');
    Route::get('/csv-download', [CsvController::class, 'download'])->name('csv.download');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/ui/view-mode', [UiPreferenceController::class, 'setViewMode'])
        ->middleware('auth')
        ->name('ui.viewmode');

});

require __DIR__ . '/auth.php';

