<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ImagesController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\ContactsController;

use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\User\TicketsController;
use App\Http\Controllers\OrganizationsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CoordinateController;
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

Route::get('/welcome', function () {
    return Inertia::render('Guest/Welcome');
})->middleware('guest')->name('welcome');



// Auth

Route::post('register', [RegistrationController::class, 'store'])
    ->name('register')
    ->middleware('guest');

Route::post('email/resend', [VerificationController::class, 'resend'])
    ->name('verification.resend');

Route::get('email/verify', [VerificationController::class, 'show'])
    ->name('verification.notice');

Route::get('email/verify/{id}/{hash}', [VerificationController::class, 'verify'])
    ->name('verification.verify');

Route::get('login', [AuthenticatedSessionController::class, 'create'])
    ->name('login.index')
    ->middleware('guest');

Route::post('login', [AuthenticatedSessionController::class, 'store'])
    ->name('login.store')
    ->middleware('guest');

Route::delete('logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');



// ┌──────────────────────────────────────────────────────────────────────────────┐
// │     Admin                                                                    │
// └──────────────────────────────────────────────────────────────────────────────┘

// Dashboard

Route::get('/', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->middleware(['auth', 'verified']);


// Users
Route::resource('/users', UsersController::class)->middleware(['auth', 'verified']);


Route::put('users/{user}/restore', [UsersController::class, 'restore'])
    ->name('users.restore')
    ->middleware(['auth', 'verified']);



// Coordinate
Route::get('/coordinate/login/', [CoordinateController::class, 'login'])->middleware(['auth', 'verified']);
Route::get('/coordinate/logout/', [CoordinateController::class, 'logout'])->middleware(['auth', 'verified']);
Route::resource('/coordinate', CoordinateController::class)->middleware(['auth', 'verified']);







// ┌──────────────────────────────────────────────────────────────────────────────┐
// │     User                                                                     │
// └──────────────────────────────────────────────────────────────────────────────┘



Route::resource('/tickets', TicketsController::class)->middleware(['auth', 'verified']);
Route::get('/tickets/download/{id}', [TicketsController::class, 'download'])->middleware(['auth', 'verified']);















// // Contacts

// Route::get('contacts', [ContactsController::class, 'index'])
//     ->name('contacts')
//     ->middleware('auth');

// Route::get('contacts/create', [ContactsController::class, 'create'])
//     ->name('contacts.create')
//     ->middleware('auth');

// Route::post('contacts', [ContactsController::class, 'store'])
//     ->name('contacts.store')
//     ->middleware('auth');

// Route::get('contacts/{contact}/edit', [ContactsController::class, 'edit'])
//     ->name('contacts.edit')
//     ->middleware('auth');

// Route::put('contacts/{contact}', [ContactsController::class, 'update'])
//     ->name('contacts.update')
//     ->middleware('auth');

// Route::delete('contacts/{contact}', [ContactsController::class, 'destroy'])
//     ->name('contacts.destroy')
//     ->middleware('auth');

// Route::put('contacts/{contact}/restore', [ContactsController::class, 'restore'])
//     ->name('contacts.restore')
//     ->middleware('auth');

// // Reports

// Route::get('reports', [ReportsController::class, 'index'])
//     ->name('reports')
//     ->middleware('auth');

// // Images

// Route::get('/img/{path}', [ImagesController::class, 'show'])
//     ->where('path', '.*')
//     ->name('image');
