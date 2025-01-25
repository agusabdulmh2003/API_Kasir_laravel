<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('products', ProductController::class);
    Route::apiResource('sales', SaleController::class);
    Route::apiResource('debts', DebtController::class);
    Route::apiResource('stocks', StockController::class);
});
