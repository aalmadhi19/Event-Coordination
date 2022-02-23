<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\User\TicketsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CoordinateController;
use App\Http\Controllers\Admin\ManagementController;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

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

// Guest


// ┌──────────────────────────────────────────────────────────────────────────────┐
// │     Guest                                                                    │
// └──────────────────────────────────────────────────────────────────────────────┘

Route::group(['middleware' => ['guest']], function () {

    Route::get('/welcome', function () {
        return Inertia::render('Guest/Welcome');
    })->name('welcome');

    Route::post('register', [RegistrationController::class, 'store'])->name('register');

    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login.index');

    Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('login.store');
});



// ┌──────────────────────────────────────────────────────────────────────────────┐
// │     Auth                                                                     │
// └──────────────────────────────────────────────────────────────────────────────┘

Route::group(['middleware' => ['auth']], function () {

    Route::get('email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');

    Route::post('email/resend', [VerificationController::class, 'resend'])->name('verification.resend');

    Route::get('email/verify', [VerificationController::class, 'show'])->name('verification.notice');

    Route::delete('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    Route::get('set-locale/{locale}', function ($locale) {
        app()->setLocale($locale);
        session()->put('locale', $locale);
        return redirect()->back();
    });
});




// ┌──────────────────────────────────────────────────────────────────────────────┐
// │     Admin                                                                    │
// └──────────────────────────────────────────────────────────────────────────────┘

Route::group(['middleware' => ['auth', 'verified', 'admin']], function () {


    // Dashboard
    Route::get('/', [DashboardController::class, 'index']);


    // Users
    Route::resource('/users', UsersController::class);
    Route::put('users/{user}/restore', [UsersController::class, 'restore']);



    // Coordinate
    Route::get('/coordinate/login/', [CoordinateController::class, 'login']);
    Route::post('/coordinate/login/read', [CoordinateController::class, 'loginRead']);
    Route::get('/coordinate/logout/', [CoordinateController::class, 'logout']);
    Route::post('/coordinate/logout/read', [CoordinateController::class, 'logoutRead']);
    Route::resource('/coordinate', CoordinateController::class);


    // Management
    Route::resource('/management', ManagementController::class);
});





// ┌──────────────────────────────────────────────────────────────────────────────┐
// │     User                                                                     │
// └──────────────────────────────────────────────────────────────────────────────┘
Route::group(['middleware' => ['auth', 'verified']], function () {

    Route::get('/tickets/download/{id}', [TicketsController::class, 'download']);
    Route::resource('/tickets', TicketsController::class);
});
