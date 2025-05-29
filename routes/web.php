<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;


// Root route
Route::get('/', function () {
    return redirect()->route('admin.dashboard'); // Or login view
})->middleware('auth');

// Admin routes
Route::group(['middleware' => ['auth:sales,admin'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
});

// Developer routes
Route::group(['middleware' => ['auth:developer'], 'prefix' => 'developer', 'as' => 'developer.'], function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
});

// Developer routes
Route::group(['middleware' => ['auth:sales'], 'prefix' => 'sales', 'as' => 'sales.'], function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
});

// Employee routes (protected by admin auth)
Route::group(['middleware' => ['auth:sales,admin'], 'prefix' => 'employee', 'as' => 'employee.'], function () {
    Route::get('/', [EmployeeController::class, 'index'])->name('list'); 
    Route::get('/create', [EmployeeController::class, 'create'])->name('create'); 
    Route::post('/store', [EmployeeController::class, 'store'])->name('store'); 
    Route::get('/edit/{id}', [EmployeeController::class, 'edit'])->name('edit'); 
    Route::put('/update/{id}', [EmployeeController::class, 'update'])->name('update');
    Route::get('/view/{id}', [EmployeeController::class, 'detail'])->name('view'); 
    Route::get('/delete/{id}', [EmployeeController::class, 'delete'])->name('delete'); 
});

Route::group(['middleware' => ['auth:sales,admin'], 'prefix' => 'customer', 'as' => 'customer.'], function () {
    Route::get('/', [CustomerController::class, 'index'])->name('list'); 
    Route::get('/create', [CustomerController::class, 'create'])->name('create'); 
    Route::post('/store', [CustomerController::class, 'store'])->name('store'); 
    Route::get('/edit/{id}', [CustomerController::class, 'edit'])->name('edit'); 
    Route::put('/update/{id}', [CustomerController::class, 'update'])->name('update');
    Route::get('/view/{id}', [CustomerController::class, 'detail'])->name('view'); 
    Route::get('/delete/{id}', [CustomerController::class, 'delete'])->name('delete'); 
});

Route::group(['middleware' => ['auth:sales,admin'], 'prefix' => 'project', 'as' => 'project.'], function () {
    Route::get('/', [ProjectController::class, 'index'])->name('list'); 
    Route::get('/create', [ProjectController::class, 'create'])->name('create'); 
    Route::post('/store', [ProjectController::class, 'store'])->name('store'); 
    Route::get('/edit/{id}', [ProjectController::class, 'edit'])->name('edit'); 
    Route::put('/update/{id}', [ProjectController::class, 'update'])->name('update');
    Route::get('/view/{id}', [ProjectController::class, 'show'])->name('view'); 
    Route::get('/delete/{id}', [ProjectController::class, 'delete'])->name('delete'); 
    Route::post('/update-status/{id}', [ProjectController::class, 'updateStatus']);
});

Route::group(['middleware' => ['auth:sales,admin'], 'prefix' => 'invoice', 'as' => 'invoice.'], function () {
    Route::get('/', [InvoiceController::class, 'index'])->name('list'); 
    Route::get('/create', [InvoiceController::class, 'create'])->name('create'); 
    Route::post('/store', [InvoiceController::class, 'store'])->name('store'); 
    Route::get('/edit/{id}', [InvoiceController::class, 'edit'])->name('edit'); 
    Route::put('/update/{id}', [InvoiceController::class, 'update'])->name('update');
    Route::get('/view/{id}', [InvoiceController::class, 'show'])->name('view'); 
    Route::get('/delete/{id}', [InvoiceController::class, 'delete'])->name('delete'); 
    Route::post('/update-status/{id}', [InvoiceController::class, 'updateStatus']);
});


Route::get('login',[AuthController::class,'login'])->name('login');
Route::post('login',[AuthController::class,'loginAttempt'])->name('login.attempt');
Route::get('logout',[AuthController::class,'logout'])->name('logout');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/home')->with('verified', true);
})->middleware(['auth', 'signed'])->name('verification.verify');
