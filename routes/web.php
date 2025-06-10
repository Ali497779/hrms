<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AttendanceController;
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

Route::group(['middleware' => ['auth:sales,admin,developer,projectmanager'], 'prefix' => 'attendance', 'as' => 'attendance.'], function () {
    Route::post('/check-in', [AttendanceController::class, 'checkIn'])->name('check-in');
    Route::post('/check-out', [AttendanceController::class, 'checkout'])->name('check-out');
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

Route::group(['middleware' => ['auth:sales,admin'], 'prefix' => 'sale', 'as' => 'sale.'], function () {
    // Route::get('/', [SaleController::class, 'index'])->name('list'); 
    Route::get('/', [SaleController::class, 'InvoiceList'])->name('list'); 
    Route::get('/create', [SaleController::class, 'create'])->name('create'); 
    Route::post('/store', [SaleController::class, 'store'])->name('store'); 
    Route::get('/edit/{id}', [SaleController::class, 'edit'])->name('edit'); 
    Route::put('/update/{id}', [SaleController::class, 'update'])->name('update');
    Route::get('/view/{id}', [SaleController::class, 'show'])->name('view'); 
    Route::get('/delete/{id}', [SaleController::class, 'delete'])->name('delete'); 
    Route::post('/update-status/{id}', [SaleController::class, 'updateStatus']);
    Route::post('/send_invoice', [SaleController::class, 'SendInvoice'])->name('send_invoice');
});

Route::group(['middleware' => ['auth:sales,admin'], 'prefix' => 'lead', 'as' => 'lead.'], function () {
    Route::get('/', [LeadController::class, 'index'])->name('list'); 
    Route::get('/create', [LeadController::class, 'create'])->name('create'); 
    Route::post('/store', [LeadController::class, 'store'])->name('store'); 
    Route::get('/edit/{id}', [LeadController::class, 'edit'])->name('edit'); 
    Route::put('/update/{id}', [LeadController::class, 'update'])->name('update');
    Route::get('/view/{id}', [LeadController::class, 'show'])->name('view'); 
    Route::get('/delete/{id}', [LeadController::class, 'delete'])->name('delete'); 
    Route::post('/update-status/{id}', [LeadController::class, 'updateStatus']);
});

Route::group(['middleware' => ['auth:sales,admin,developer,projectmanager'], 'prefix' => 'ticket', 'as' => 'ticket.'], function () {
    Route::get('/', [TicketController::class, 'index'])->name('list'); 
    Route::get('/create', [TicketController::class, 'create'])->name('create'); 
    Route::post('/store', [TicketController::class, 'store'])->name('store'); 
    Route::get('/edit/{id}', [TicketController::class, 'edit'])->name('edit'); 
    Route::post('/approve/{id}', [TicketController::class, 'approve'])->name('approve'); 
    Route::post('/reject/{id}', [TicketController::class, 'reject'])->name('reject'); 
    Route::put('/update/{id}', [TicketController::class, 'update'])->name('update');
    Route::get('/view/{id}', [TicketController::class, 'show'])->name('view'); 
    Route::get('/delete/{id}', [TicketController::class, 'delete'])->name('delete'); 
    Route::post('/update-status/{id}', [TicketController::class, 'updateStatus']);
});

Route::group(['middleware' => ['auth:sales,admin'], 'prefix' => 'payroll', 'as' => 'payroll.'], function () {
    Route::get('/', [LeadController::class, 'index'])->name('list'); 
    Route::get('/create', [LeadController::class, 'create'])->name('create'); 
    Route::post('/store', [LeadController::class, 'store'])->name('store'); 
    Route::get('/edit/{id}', [LeadController::class, 'edit'])->name('edit'); 
    Route::put('/update/{id}', [LeadController::class, 'update'])->name('update');
    Route::get('/view/{id}', [LeadController::class, 'show'])->name('view'); 
    Route::get('/delete/{id}', [LeadController::class, 'delete'])->name('delete'); 
    Route::post('/update-status/{id}', [LeadController::class, 'updateStatus']);
});


Route::get('login',[AuthController::class,'login'])->name('login');
Route::post('login',[AuthController::class,'loginAttempt'])->name('login.attempt');
Route::get('logout',[AuthController::class,'logout'])->name('logout');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/home')->with('verified', true);
})->middleware(['auth', 'signed'])->name('verification.verify');
