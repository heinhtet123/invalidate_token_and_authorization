<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::group(['middleware' => ['auth:api','jwt.auth']],function(){
    Route::get('profile', [Controllers\ProfileController::class, 'profile']);
    Route::post('/logout', [Controllers\AuthController::class,'logout'])->name('auth_logout');

});


Route::post('/login', [Controllers\AuthController::class,'login'])->name('auth_login');
Route::post('/register', [Controllers\AuthController::class,'register'])->name('auth_register');
