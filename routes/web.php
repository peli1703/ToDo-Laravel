<?php

use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::middleware('isGuest')->group(function() {
    Route::get('/', [TodoController::class, 'form'])->name('login');
    Route::post('/register', [TodoController::class, 'inputRegister']);
    Route::post('/index', [TodoController::class, 'auth'])->name('loginauth');
});
Route::get('/logout', [TodoController::class, 'logout'])->name('logout');


// todo
// fungsi prefix induknya, yg ada di dalam trefix yaitu anak"nya
Route::middleware('isLogin')->prefix('/todo')->name('todo.')->group(function () {
    Route::get('/', [TodoController::class, 'index'])->name('index');
    Route::get('/complated', [TodoController::class, 'complated'])->name('complated');
    Route::get('/create', [TodoController::class, 'create'])->name('create');
    Route::post('/store', [TodoController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [TodoController::class, 'edit'])->name('edit');
    Route::patch('/update/{id}', [TodoController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [TodoController::class, 'destroy'])->name('delete');
    Route::patch('/update/{id}', [TodoController::class, 'update'])->name('update');
    Route::patch('/complated/{id}', [TodoController::class, 'updateComplated'])->name('update-complated');
});