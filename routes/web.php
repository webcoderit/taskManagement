<?php

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

Route::get('/', function () {
    return view('backend.users.auth.login');
});

Route::group(['prefix' => 'admin'], function(){
    Route::get('/login', [App\Http\Controllers\Admin\AdminController::class, 'loginForm'])->name('admin.login.form');
    Route::post('/login', [App\Http\Controllers\Admin\AdminController::class, 'login'])->name('admin.login');
    Route::get('/dashboard', [App\Http\Controllers\Admin\AdminController::class, 'deshboard'])->name('admin.deshboard');
    Route::get('/register', [App\Http\Controllers\Admin\AdminController::class, 'register'])->name('admin.user.list');
    Route::get('/add/user', [App\Http\Controllers\Admin\AdminController::class, 'createForm'])->name('admin.user.register.form.create');

    Route::group(['prefix' => 'user'], function (){
        Route::post('/store', [App\Http\Controllers\Admin\AdminController::class, 'store'])->name('admin.user.register');
        Route::get('/edit/{user}', [App\Http\Controllers\Admin\AdminController::class, 'edit'])->name('admin.user.edit');
        Route::post('/update/{user}', [App\Http\Controllers\Admin\AdminController::class, 'update'])->name('admin.user.update');
        Route::get('/active/{user}', [App\Http\Controllers\Admin\AdminController::class, 'active'])->name('admin.user.active');
        Route::get('/inactive/{user}', [App\Http\Controllers\Admin\AdminController::class, 'inactive'])->name('admin.user.inactive');
        Route::get('/delete/{user}', [App\Http\Controllers\Admin\AdminController::class, 'destroy'])->name('admin.user.destroy');
        Route::get('/delete/{user}', [App\Http\Controllers\Admin\AdminController::class, 'destroy'])->name('admin.user.destroy');
        Route::get('/logout', [App\Http\Controllers\Admin\AdminController::class, 'logout'])->name('admin.user.logout');
        Route::get('/add/task', [App\Http\Controllers\Admin\AdminController::class, 'addTask'])->name('admin.add.task');
    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
