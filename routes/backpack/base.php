<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\MyAccountController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Backpack\Base Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are
| handled by the Backpack\Base package.
|
*/

// Password recovery routes
Route::group(
    [
        'namespace'  => 'Backpack\CRUD\app\Http\Controllers',
        'middleware' => config('backpack.base.web_middleware', 'web'),
        'prefix'     => config('backpack.base.custom_prefixes.password-recovery'),
    ],
    function () {
        Route::get('reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('backpack.auth.password.reset');
        Route::post('reset', 'Auth\ResetPasswordController@reset');
        Route::get('reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('backpack.auth.password.reset.token');
        Route::post('email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('backpack.auth.password.email')->middleware('backpack.throttle.password.recovery:' . config('backpack.base.password_recovery_throttle_access'));
    }
);

// Dashboard & logout routes
Route::group(
    [
        // 'namespace'  => 'Backpack\CRUD\app\Http\Controllers',
        'middleware' => config('backpack.base.web_middleware', 'web'),
        'prefix'     => config('backpack.base.custom_prefixes.admin'),
    ],
    function () {
        Route::get('dashboard', [AdminController::class, 'dashboard'])->name('backpack.dashboard');
        Route::get('/', 'AdminController@redirect')->name('backpack');
        Route::get('logout', [LoginController::class, 'logout'])->name('backpack.auth.logout');
        Route::post('logout', [LoginController::class, 'logout']);
    }
);

// Acount routes
Route::group([
    'middleware' => config('backpack.base.web_middleware', 'web'),
    'prefix'     => config('backpack.base.custom_prefixes.account'),
], function () {
    Route::get('edit-account-info', [MyAccountController::class, 'getAccountInfoForm'])->name('backpack.account.info');
    Route::post('edit-account-info', [MyAccountController::class, 'postAccountInfoForm'])->name('backpack.account.info.store');
    Route::post('edit-account-address', [MyAccountController::class, 'postAccountAddressForm'])->name('backpack.account.address.store');
    Route::post('change-password', [MyAccountController::class, 'postChangePasswordForm'])->name('backpack.account.password');
});

// Authentication Routes...
Route::group([
    'middleware' => config('backpack.base.web_middleware', 'web'),
    'prefix'     => config('backpack.base.custom_prefixes.auth'),
], function () {
    Route::prefix('google')->name('google.')->group(function () {
        Route::get('login', [LoginController::class, 'loginGoogle'])->name('login');
        Route::get('callback', [LoginController::class, 'callbackGoogle'])->name('callback');
    });
    Route::prefix('facebook')->name('facebook.')->group(function () {
        Route::get('login', [LoginController::class, 'loginFacebook'])->name('login');
        Route::get('callback', [LoginController::class, 'callbackFacebook'])->name('callback');
    });
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('backpack.auth.login');
    Route::post('login', [LoginController::class, 'login']);
});

// Registration Routes...
Route::group([
    'middleware' => config('backpack.base.web_middleware', 'web'),
    'prefix'     => config('backpack.base.custom_prefixes.registration'),
], function () {
    Route::get('create-account', [RegisterController::class, 'showRegistrationForm'])->name('backpack.auth.register');
    Route::post('create-account', [RegisterController::class, 'register']);
});