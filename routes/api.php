<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WebsiteController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('users', [UserController::class, 'store']);
Route::get('websites', [WebsiteController::class, 'index']);
Route::post('websites/{website}/posts', [PostController::class, 'store']);
Route::post('websites/{website}/subscribe', [SubscriptionController::class, 'subscribe']);
