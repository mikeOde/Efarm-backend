<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\FarmerController;

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

	Route::group(['middleware' => 'admin'], function () {
        Route::post('/edit_profiles', [FarmerController::class, 'editProfile'])->name('api:edit_profile');
        
		
	});
    Route::get('/user_profile', [AuthController::class, 'userProfile'])->name('api:user_profile');
	Route::get('/get_trees', [UserController::class, 'getTrees'])->name('api:get_trees');
});
