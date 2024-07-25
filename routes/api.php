<?php

use App\Http\Controllers\Auth\UserAuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\FriendController;
use Illuminate\Support\Facades\Route;

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

Route::post('register', [UserAuthController::class, 'register']);
Route::post('login', [UserAuthController::class, 'login']);
Route::post('logout', [UserAuthController::class, 'logout'])
  ->middleware('auth:sanctum');

Route::middleware(['auth:sanctum'])->group(function () {
  Route::get('friends/sent', [UserController::class, 'pendingRequestsTo']); // get all sender sent requests
  Route::get('friends/recieved', [UserController::class, 'pendingRequestsFrom']); // get all recieved sent requests
  Route::get('friends', [UserController::class, 'friends']); // accept sent friend request

  Route::post('friends/accept/{user}', [FriendController::class, 'acceptRequest']); // accept sent friend request
  Route::post('friends/remove/{user}', [FriendController::class, 'removeRequest']); // remove friend request

});
