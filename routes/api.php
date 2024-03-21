<?php

use App\Http\Controllers\Auth\{
    ForgotPasswordController,
    LoginController,
    LogoutController,
    MeController,
    RegisterController,
    ResetPasswordController,
};

use App\Http\Controllers\Finance\{
    AccountController,
    DashboardController,
    OperationController,
    UserController,
};

use Illuminate\Support\Facades\Route;

/** 
 * Auth Routes 
 * */
Route::prefix('auth')->group(function () {
    Route::middleware(['guest'])->group( function () {
        Route::post('/register', RegisterController::class)->name('auth.register');
        Route::post('/login', LoginController::class)->name('auth.login');
        Route::post('/forgot-password', ForgotPasswordController::class)->name('auth.forgot-password');
        Route::post('/reset-password', ResetPasswordController::class)->name('auth.reset-password');
    });
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::get('/me', MeController::class)->name('auth.me');
        Route::post('/logout', LogoutController::class)->name('auth.logout');
    });
});

/* Routes Dashboard */
Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('/accounts', AccountController::class);
    Route::apiResource('/operations', OperationController::class);
    Route::middleware(['admin'])->group(function () {
        Route::apiResource('/dashboard', DashboardController::class)->only('index');
        Route::apiResource('/users', UserController::class);
    });
});


/** 
 * Route Status 
 * */
Route::get('/', function () {
    return response()->json(['status' => true]);
})->name('status');