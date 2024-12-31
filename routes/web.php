<?php

use App\Http\Controllers\ListingController;
use App\Http\Controllers\Front\StoreController;
use App\Http\Controllers\UserController;
use App\Models\Listing;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::prefix('store/')->group(function () {
    Route::get('home', [StoreController::class, 'home'])->name('store.home');
    Route::get('listings', [StoreController::class, 'allListings'])->name('allListings');
    Route::get('listings/create', [StoreController::class, 'showCreate'])->middleware('auth')->name('create');
    Route::post('listings', [StoreController::class, 'storeListing'])->middleware('auth')->name('storeListing');
    Route::get('listings/{id}', [StoreController::class, 'showDetailes'])->name('detailes');
    Route::get('listings/{id}/edit', [StoreController::class, 'showEdit'])->middleware('auth')->name('edit');
    Route::put('listings/{id}', [StoreController::class, 'updateListing'])->middleware('auth')->name('update');
    Route::get('manage', [StoreController::class, 'showManage'])->middleware('auth')->name('manage');
    Route::get('register', [UserController::class, 'showRegister'])->middleware('guest')->name('register');
    Route::post('users', [UserController::class, 'storeUser'])->middleware('guest')->name('storeUser');
    Route::get('login', [UserController::class, 'showLogin'])->middleware('guest')->name('login');
    Route::post('users/authenticate', [UserController::class, 'authenticate'])->name('authenticate');
    Route::post('logout', [UserController::class, 'logout'])->middleware('auth')->name('logout');
    Route::delete('listings/{id}', [StoreController::class, 'destroy'])->middleware('auth')->name('delete');
});
