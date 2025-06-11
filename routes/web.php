<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlunoController;

//Rotas padrão do Laravel/Breeze
Route::get('/', function () {
    return view('welcome'); // Ou, se preferires, redirecionar para a lista de alunos: return redirect()->route('alunos.index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Rota para exportar alunos para Excel
Route::get('alunos/export-excel', [AlunoController::class, 'exportExcel'])->name('alunos.exportExcel');

//Rota para CRUD de Alunos
Route::resource('alunos', AlunoController::class);

require __DIR__ . '/auth.php';