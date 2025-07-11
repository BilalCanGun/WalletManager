<?php

use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExchangeRateController;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WalletController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schedule;

Route::get('/dashboard', function () {
    dd(Auth::user());
});
Schedule::command('currency:update-daily')->dailyAt('14:37');
Auth::routes(['register' => false]);

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    Route::get('/wallets', [WalletController::class, 'index'])->name('wallets.index');
    Route::post('/wallets', [WalletController::class, 'store'])->name('wallets.store');
    Route::put('/wallets/{walletid}', [WalletController::class, 'update'])->name('wallets.update');
    Route::delete('/wallets/{walletid}', [WalletController::class, 'destroy'])->name('wallets.destroy');

    Route::get('/goals', [GoalController::class, 'index'])->name('goals.index');
    Route::post('/goals', [GoalController::class, 'store'])->name('goals.store');
    Route::put('/goals/{goalid}', [GoalController::class, 'update'])->name('goals.update');
    Route::delete('/goals/{goalid}', [GoalController::class, 'destroy'])->name('goals.destroy');

    Route::get('/currencies', [CurrencyController::class, 'index'])->name('currencies.index');
    Route::get('/update-currencies', [CurrencyController::class, 'updateCurrencies']);
    Route::get('/update-gold', [CurrencyController::class, 'getGoldPrice']);
});
