<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\WalletController;
use Illuminate\Support\Facades\Route;


Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// 👇 Bu şekilde korumalı rotalar middleware ile tanımlanır:
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [UserController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);



    Route::get('/wallets', [WalletController::class, 'index']);
    Route::post('/wallets', [WalletController::class, 'store']);
    Route::put('/wallets/{walletid}', [WalletController::class, 'update']);
    Route::delete('/wallets/{walletid}', [WalletController::class, 'destroy']);
});
