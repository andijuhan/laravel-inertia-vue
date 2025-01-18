<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\ListingOfferController;
use App\Http\Controllers\UserAccountController;
use App\Http\Controllers\RealtorListingController;
use App\Http\Controllers\RealtorListingImageController;

Route::get('/', [IndexController::class, 'index']);
Route::get('/hello', [IndexController::class, 'show']);

Route::resource('listing', ListingController::class)
    ->only(['index', 'show']);

Route::resource('listing.offer', ListingOfferController::class)
    ->middleware('auth')
    ->only(['store']);

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'create')->name('login');
    Route::post('/login', 'store')->name('login.store');
    Route::delete('/logout', 'destroy')->name('logout');
});

Route::controller(UserAccountController::class)
    ->prefix('user-account')
    ->group(function () {
        Route::get('/create', 'create')->name('user-account.create');
        Route::post('/create', 'store')->name('user-account.store');
    });

Route::prefix('realtor')
    ->name('realtor.')
    ->middleware('auth')
    ->group(function () {
        Route::name('listing.restore')
            ->put('listing/{listing}/restore', [RealtorListingController::class, 'restore'])
            ->withTrashed();
        Route::resource('listing', RealtorListingController::class)
            ->withTrashed(['destroy']);
        Route::resource('listing.image', RealtorListingImageController::class)
            ->only(['create', 'store', 'destroy']);
    });
