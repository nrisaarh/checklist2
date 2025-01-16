<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChecklistController;
use App\Http\Controllers\PicController;
use App\Http\Controllers\YearController;

Route::get('/checklists', [ChecklistController::class, 'index'])->name('checklists.index'); // Tampilkan semua checklist
Route::get('/checklists/create', [ChecklistController::class, 'create'])->name('checklists.create'); // Form tambah checklist
Route::post('/checklists', [ChecklistController::class, 'store'])->name('checklists.store'); // Simpan checklist baru
Route::get('/pics', [PicController::class, 'index'])->name('pics.index');
Route::post('/pics', [PicController::class, 'store'])->name('pics.store'); //Tammbah PIC baru
Route::delete('/pics/{id}', [PicController::class, 'destroy'])->name('pics.destroy'); //Delete PIC
Route::get('/checklists/{id}/edit', [ChecklistController::class, 'edit'])->name('checklists.edit'); // Form edit checklist
Route::put('/checklists/{id}', [ChecklistController::class, 'update'])->name('checklists.update'); // Update checklist
Route::delete('/checklists/{id}', [ChecklistController::class, 'destroy'])->name('checklists.destroy'); // Hapus checklist
Route::post('/add-year', [YearController::class, 'addYear'])->name('addYear'); // Tambah tahun

Route::get('/', function () {
    return view('welcome');
});
