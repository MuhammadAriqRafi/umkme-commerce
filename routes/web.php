<?php

use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// !! Routes for Guest
Route::middleware('guest')->group(function () {
    Route::get('/', [LoginController::class, 'index'])->name('login');
    Route::post('/', [LoginController::class, 'authenticate']);
    Route::get('/forgot-password', [ForgotPasswordController::class, 'index']);
});

// !! Routes for Admin
Route::middleware('auth')->prefix('/admin')->name('admin.')->group(function () {
    Route::get('/', [ProductController::class, 'index']);
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::resource('products', ProductController::class);
    Route::resource('orders', OrderController::class)->except('create', 'edit');
    // Route::get('/status/{orderStatus}', [OrderController::class, 'index'])->name('.index.withStatus');
});


// !! Routes for Admin ONLY
// Route::middleware('admin')->group(function () {
//     Route::prefix('/admin')->name('admin')->group(function () {
//         Route::get('/', [PageController::class, 'index']);
//     });

//     Route::prefix('/product')->name('product')->group(function () {
//         Route::resource('/', ProductController::class)->except('index')->names([
//             'show' => '.show',
//             'create' => '.create',
//             'store' => '.store',
//             'edit' => '.edit',
//             'update' => '.update',
//             'destroy' => '.destroy'
//         ]);
//     });
// });

// !! Routes for authentication
// Route::middleware('guest')->group(function () {
//     Route::name('login')->group(function () {
//         Route::get('/login', [LoginController::class, 'index']);
//         Route::post('/login', [LoginController::class, 'postLogin']);
//     });

//     Route::name('register')->group(function () {
//         Route::get('/register', [RegisterController::class, 'index']);
//         Route::post('/register', [RegisterController::class, 'postRegister']);
//     });

//     Route::name('forgot.password')->group(function () {
//         Route::get('/forgot-password', [ForgotPasswordController::class, 'index']);
//         Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetPasswordLink']);
//     });

//     Route::name('reset.password')->group(function () {
//         Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'resetPassword']);
//         Route::post('/reset-password', [ForgotPasswordController::class, 'resetPasswordPost']);
//     });
// });
