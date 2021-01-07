<?php

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
Route::get('/', function () {
    return redirect()->route('dashboard');
});
// Route::get('/email/verify', [App\Http\Controllers\Auth\VerificationController::class, 'show'])->name('verification.notice');
// Route::get('/email/verify/{id}', [App\Http\Controllers\Auth\VerificationController::class, 'verify'])->name('verification.verify');
// Route::post('/email/resend', [App\Http\Controllers\Auth\VerificationController::class, 'resend'])->name('verification.resend');
Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth','verified']], function () {
    Route::get('/', function () {
        return redirect()->route('dashboard');
    });
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/dashboard', [App\Http\Controllers\Admin\Dashboard\DashboardController::class, 'index'])->name('dashboard');
});
Route::get('oauth/{driver}', [App\Http\Controllers\Auth\OAuthController::class, 'redirect']);
Route::get('oauth/{driver}/callback', [App\Http\Controllers\Auth\OAuthController::class, 'handleCallback'])->name('oauth.callback');
Auth::routes(['verify'=>true]);
