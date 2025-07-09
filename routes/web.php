<?php

use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\TicketCreatedMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DollarController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PublicHolidayController;
use App\Http\Controllers\StripeWebhookController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Models\Ticket;
use Illuminate\Support\Carbon;


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

Route::group(['middleware' => ['auth:projectmanager'], 'prefix' => 'pm', 'as' => 'pm.'], function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
});


Route::group(['middleware' => ['auth:designer'], 'prefix' => 'designer', 'as' => 'designer.'], function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
});

// Employee routes (protected by admin auth)
Route::group(['middleware' => ['auth:sales,admin'], 'prefix' => 'employee', 'as' => 'employee.'], function () {
    Route::get('/', [EmployeeController::class, 'index'])->name('list'); 
    Route::get('/create', [EmployeeController::class, 'create'])->name('create'); 
    Route::post('/store', [EmployeeController::class, 'store'])->name('store'); 
    Route::get('/edit/{id}', [EmployeeController::class, 'edit'])->name('edit'); 
    Route::get('/calender/{id}/{month?}/{year?}', [EmployeeController::class, 'calender'])->name('calender');
    Route::put('/update/{id}', [EmployeeController::class, 'update'])->name('update');
    Route::get('/view/{id}', [EmployeeController::class, 'detail'])->name('view'); 
    Route::get('/delete/{id}', [EmployeeController::class, 'delete'])->name('delete'); 
});

Route::group(['middleware' => ['auth:sales,admin,developer,projectmanager,designer']], function () {
Route::get('mycalender/{month?}/{year?}',[EmployeeController::class, 'myCalender'])->name('mycalender');
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

Route::group(['middleware' => 'auth:sales,admin,developer,projectmanager,designer'], function() {
    Route::post('/notifications/{id}/read', function($id) {
        auth()->user()->notifications()->where('id', $id)->update(['read_at' => now()]);
        return response()->json(['success' => true]);
    });
    
    Route::post('/notifications/read-all', function() {
        auth()->user()->unreadNotifications->markAsRead();
        return response()->json(['success' => true]);
    });
    
    Route::post('/notifications/{id}/delete', function($id) {
        auth()->user()->notifications()->where('id', $id)->delete();
        return response()->json(['success' => true]);
    });
    
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
});


// Route::get('/test-ticket-mail', function () {
//     $user = User::where('email', 'aliazeemkhan666@gmail.com')->first();

//     // Fallback: Create test ticket if none exists
//     $ticket = Ticket::latest()->first();
//     if (!$ticket) {
//         $ticket = Ticket::create([
//             'user_id' => $user->id,
//             'date' => Carbon::now()->format('Y-m-d'),
//             'reason' => 'Test reason for leave',
//         ]);
//     }

//     Mail::to('aliazeemkhan666@gmail.com')->send(new TicketCreatedMail($ticket, $user));

//     return 'Email sent to ' . $user->email;
// });

Route::group(['middleware' => ['auth:sales,admin,developer,projectmanager,designer'], 'prefix' => 'attendance', 'as' => 'attendance.'], function () {
    Route::post('/check-in', [AttendanceController::class, 'checkIn'])->name('check-in');
    Route::post('/check-out', [AttendanceController::class, 'checkout'])->name('check-out');
});

Route::group(['middleware' => ['auth:sales,admin,designer'], 'prefix' => 'project', 'as' => 'project.'], function () {
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
    Route::get('/stripe/webhook', [StripeWebhookController::class, 'handleWebhook']);
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

Route::group(['middleware' => ['auth:sales,admin,developer,projectmanager,designer'], 'prefix' => 'ticket', 'as' => 'ticket.'], function () {
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

Route::group(['middleware' => ['auth:sales,admin,developer,projectmanager,designer'], 'prefix' => 'payroll', 'as' => 'payroll.'], function () {
    Route::get('/', [PayrollController::class, 'index'])->name('list')->middleware('auth:admin'); 
    Route::get('/create', [PayrollController::class, 'create'])->name('create')->middleware('auth:admin'); 
    Route::post('/store', [PayrollController::class, 'store'])->name('store')->middleware('auth:admin'); 
    Route::post('/view', [PayrollController::class, 'show'])->name('view')->middleware('auth:admin'); 
    Route::get('/check', [PayrollController::class, 'check'])->name('check'); 
    Route::post('/check', [PayrollController::class, 'checkpost'])->name('check'); 
});

Route::group(['middleware' => ['auth:admin'], 'prefix' => 'holiday', 'as' => 'holiday.'], function () {
    Route::get('/', [PublicHolidayController::class, 'index'])->name('list')->middleware('auth:admin'); 
    Route::get('/create', [PublicHolidayController::class, 'create'])->name('create')->middleware('auth:admin'); 
    Route::post('/store', [PublicHolidayController::class, 'store'])->name('store')->middleware('auth:admin'); 
    Route::get('/edit/{id}', [PublicHolidayController::class, 'edit'])->name('edit')->middleware('auth:admin'); 
    Route::post('/delete/{id}', [PublicHolidayController::class, 'delete'])->name('delete'); 
    Route::put('/update/{id}', [PublicHolidayController::class, 'update'])->name('update');

});

Route::group(['middleware' => ['auth:admin'], 'prefix' => 'setting', 'as' => 'setting.'], function () {
    Route::get('/dollar', [DollarController::class, 'index'])->name('dollar');
    Route::post('/dollar/store', [DollarController::class, 'store'])->name('dollar.store');
});


Route::get('login',[AuthController::class,'login'])->name('login');
Route::post('login',[AuthController::class,'loginAttempt'])->name('login.attempt');
Route::get('logout',[AuthController::class,'logout'])->name('logout');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/home')->with('verified', true);
})->middleware(['auth', 'signed'])->name('verification.verify');
