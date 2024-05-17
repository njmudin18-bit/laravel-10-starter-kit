<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\NavigationController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PertanyaanController;
use App\Http\Controllers\PernyataanController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::middleware('guest')->group(function () {
  Route::get('/', function () {
    return view('welcome');
  });
});

Auth::routes();

Route::middleware('auth')->group(function () {
  Route::get('/home', [HomeController::class, 'index'])->name('home');
  Route::resource('roles', RoleController::class);
  Route::resource('navigation', NavigationController::class);
  Route::resource('permissions', PermissionController::class);
  Route::resource('users', UserController::class);

  Route::get('/users-create', [UserController::class, 'create'])->name('users.create');
  Route::post('/users-edit', [UserController::class, 'edit'])->name('users.edit');

  //PERTANYAAN
  Route::get('/pertanyaan', [PertanyaanController::class, 'index'])->name('pertanyaan.index');
  Route::get('/pertanyaan-list', [PertanyaanController::class, 'index'])->name('pertanyaan.index');
  Route::post('/pertanyaan-save', [PertanyaanController::class, 'save'])->name('pertanyaan.save');
  Route::post('/pertanyaan-edit', [PertanyaanController::class, 'edit'])->name('pertanyaan.edit');
  Route::post('/pertanyaan-update', [PertanyaanController::class, 'update'])->name('pertanyaan.update');
  Route::post('/pertanyaan-hapus', [PertanyaanController::class, 'hapus'])->name('pertanyaan.hapus');

  //PERNYATAAN
  Route::get('/pernyataan', [PernyataanController::class, 'index'])->name('pernyataan.index');
  Route::get('/pernyataan-list', [PernyataanController::class, 'index'])->name('pernyataan.index');
  Route::post('/pernyataan-save', [PernyataanController::class, 'save'])->name('pernyataan.save');
  Route::post('/pernyataan-edit', [PernyataanController::class, 'edit'])->name('pernyataan.edit');
  Route::post('/pernyataan-update', [PernyataanController::class, 'update'])->name('pernyataan.update');
  Route::post('/pernyataan-hapus', [PernyataanController::class, 'hapus'])->name('pernyataan.hapus');
});
