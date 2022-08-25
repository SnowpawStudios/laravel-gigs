<?php

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;

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

// All listings
Route::get('/', [ListingController::class, 'index']);

// Show create form
Route::get('/listings/create', [ListingController::class, 'create'])->name('listings.create')->middleware('auth');

// Store listing
Route::post('/listings/store', [ListingController::class, 'store'] )->name('listings.store')->middleware('auth');

// Manage listings
Route::get('/listings/manage', [ListingController::class, 'manage'] )->middleware('auth');

// Single listing
Route::get('/listings/{listing}', [ListingController::class, 'show'] )->name('listings.show');

// Show Edit listing form
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'] )->name('listings.edit')->middleware('auth');

// Update listing
Route::put('/listings/{listing}', [ListingController::class, 'update'] )->name('listings.update')->middleware('auth');

// Delete listing
Route::delete('/listings/{listing}', [ListingController::class, 'destroy'] )->name('listings.destroy')->middleware('auth');

// Show register create form
Route::get('/register', [UserController::class, 'create'])->middleware('guest');

// Create New User
Route::post('/users', [UserController::class, 'store']);

// Log user out
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

// Show login form
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

// Login User
Route::post('/users/authenticate', [UserController::class, 'authenticate']);

