<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [AuthController::class, 'login'])->name('api:login');                   
Route::post('/register', [AuthController::class, 'register'])->name('api:register');			  
Route::post('/refresh', [AuthController::class, 'refresh'])->name('api:refresh');

Route::group(['middleware' => 'auth.jwt'], function () {

	Route::group(['middleware' => ['admin']], function () {

		
	});
    Route::get('/user_profile', [AuthController::class, 'userProfile'])->name('api:user_profile');
	
});
