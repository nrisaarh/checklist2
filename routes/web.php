<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChecklistController;

Route::get('/checklists', [ChecklistController::class, 'index'])->name('checklists.index'); // Tampilkan semua checklist
Route::get('/checklists/create', [ChecklistController::class, 'create'])->name('checklists.create'); // Form tambah checklist
Route::post('/checklists', [ChecklistController::class, 'store'])->name('checklists.store'); // Simpan checklist baru
Route::get('/checklists/{id}/edit', [ChecklistController::class, 'edit'])->name('checklists.edit'); // Form edit checklist
Route::put('/checklists/{id}', [ChecklistController::class, 'update'])->name('checklists.update'); // Update checklist
Route::delete('/checklists/{id}', [ChecklistController::class, 'destroy'])->name('checklists.destroy'); // Hapus checklist

Route::get('/', function () {
    return view('welcome');
});
