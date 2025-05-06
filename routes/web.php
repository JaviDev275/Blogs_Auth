<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotaController;



Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::resource('/notas', NotaController::class);

Route::delete('/delete/{id}', [NotaController::class, 'destroy']);

Route::get('/editar/{id}', [NotaController::class, 'edit'])->name('notas.editar');

Route::put('/actualizar/{id}',[NotaController::class,'update']) -> name ('notas.actualizar');

Route::get('/notas/{id}',[NotaController::class,'show'])->name('notas.mostrar');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');