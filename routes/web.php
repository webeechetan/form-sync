<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\FormDataController;
use App\Http\Controllers\DomainController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Cors;

// Route::get('/', function () {
//     return 'hello world';
// });

Route::get('/register', function () {
    return view('register');
})->name('register');



Route::post('/store-form-data',[FormDataController::class,'store'])->name('store-form-data')->middleware(Cors::class);

Route::get('/admin/login', [AuthController::class, 'login'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'authenticate'])->name('admin.authenticate');

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    
    Route::get('/get-form-data',[FormDataController::class,'index'])->name('get-form-data');
    
    Route::resource('domains', DomainController::class);

    Route::get('/logout', [AuthController::class, 'logout'])->name('admin.logout');

    Route::delete('/domains/delete/{domain}', [DomainController::class, 'destroy'])->name('domains.destroy');
    Route::post('/domains/update', [DomainController::class, 'update'])->name('domains.update');

});

Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
Route::delete('/users/destroy/{user}', [UserController::class, 'destroy'])->name('user.destroy');
