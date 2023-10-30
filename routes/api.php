<?php

use App\Http\Middleware\EnsureCustomerIsActive;
use App\Http\Middleware\ValidateRegionAndCommune;
use App\Http\Middleware\ValidateRequiredFields;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/customers')->group(function () {
    Route::get('/all', [CustomerController::class, 'index'])->name('customer.all');
    Route::get('/get/{index}', [CustomerController::class, 'show'])->name('customer.get')->middleware(EnsureCustomerIsActive::class);
    Route::post('/create', [CustomerController::class, 'store'])->name('customer.create')->middleware([ValidateRegionAndCommune::class, ValidateRequiredFields::class]);
    Route::delete('/delete', [CustomerController::class, 'destroy'])->name('customer.delete')->middleware(EnsureCustomerIsActive::class);
});