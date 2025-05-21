<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

Route::group(['middleware' => ['auth:admin'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/',[AdminController::class,'dashboard'])->name('dashboard');
});

Route::group(['middleware' => ['auth:developer'], 'prefix' => 'developer', 'as' => 'developer.'], function () {
    Route::get('/',[AdminController::class,'dashboard'])->name('dashboard');
});

Route::group(['middleware' => ['auth:admin'], 'prefix' => 'employee', 'as' => 'employee.'], function () {
    Route::get('/',[EmployeeController::class,'index'])->name('list'); 
    Route::get('/create',[EmployeeController::class,'create'])->name('create'); 
    Route::post('/store',[EmployeeController::class,'store'])->name('store'); 
});


Route::get('login',[AuthController::class,'login'])->name('login');
Route::post('login',[AuthController::class,'loginAttempt'])->name('login.attempt');
Route::get('logout',[AuthController::class,'logout'])->name('logout');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/home')->with('verified', true);
})->middleware(['auth', 'signed'])->name('verification.verify');
