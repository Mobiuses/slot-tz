<?php

use App\Http\Controllers\IndexController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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

Route::get('/auth', function () {
    $user = User::first();
    Auth::login($user);

    return $user;
});


Route::middleware('auth')->group(function () {
    Route::get('/roll', [IndexController::class, 'roll']);
    Route::get('/transfer/{reward}', [IndexController::class, 'transfer']);
    Route::get('/convert/{reward}/{reward_entity}', [IndexController::class, 'convert']);
});
