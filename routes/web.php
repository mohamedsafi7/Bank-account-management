<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\TransactionController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
       // Routes for AccountController
       Route::get('/accounts', [AccountController::class, 'index'])->name('dashboard');
       Route::get('/accounts/create', [AccountController::class, 'create'])->name('accounts.create');
       Route::post('/accounts', [AccountController::class, 'store'])->name('accounts.store');
   
       // Routes for TransactionController
       Route::get('/transactions/{account}', [TransactionController::class, 'index'])->name('transactions.index');
       Route::get('/accounts/{account}/deposit', [TransactionController::class, 'showDepositForm'])->name('deposit.form');
       Route::post('/deposit', [TransactionController::class, 'processDeposit'])->name('deposit.process');

       Route::get('/accounts/{account}/withdrawal', [TransactionController::class, 'showWithdrawalForm'])->name('withdrawal.form');
       Route::post('/withdraw', [TransactionController::class, 'processWithdrawal'])->name('withdrawal.process');

       Route::get('/transfer', [TransactionController::class, 'showTransferForm'])->name('transfer.form');
       Route::post('/transfer', [TransactionController::class, 'processTransfer'])->name('transfer.process');
       Route::get('/accounts/{account}/transactions', [TransactionController::class, 'showTransactionHistory'])->name('transactions.history');


});

require __DIR__.'/auth.php';
