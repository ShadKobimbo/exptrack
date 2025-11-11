<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Mail\TestEmail;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Admin\EmailTestController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ✅ Excel export route inside the auth group
    Route::get('/expenses/export', [ExpenseController::class, 'export'])->name('expenses.export');
    
    // ✅ Excel export for selected record
    Route::post('/expenses/export-selected', [ExpenseController::class, 'exportSelected'])->name('expenses.export.selected');

    // ✅ Delete multiple selected records
    Route::delete('/expenses/bulk-delete', [ExpenseController::class, 'bulkDelete'])->name('expenses.bulkDelete');

    //Pull and display all information relating to an expenses in a modal directly from the db
    Route::get('/expenses/{expense}/ajax', [ExpenseController::class, 'ajaxShow'])->name('expenses.ajaxShow');

    Route::get('/test-email', function () {
        Mail::to('shaddev@outlook.com')->send(new TestEmail('This is a test email from your app.'));
        return '✅ Test email sent successfully! Check your inbox.';
    })->middleware('auth');

    Route::get('/emails/email-test', [EmailTestController::class, 'index'])->name('emails.email-test');
    Route::post('/emails/email-test/send', [EmailTestController::class, 'send'])->name('emails.email-test.send');

    // ✅ Resource routes
    Route::resource('expenses', ExpenseController::class);
    Route::resource('shops', ShopController::class);
    Route::resource('users', UserController::class);

});
