<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\FarmerController;
use App\Http\Controllers\API\UserController;

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
        Route::post('/add_vegetables', [FarmerController::class, 'addVegetables'])->name('api:add_vegetables');
		Route::post('/delete_vegetable', [FarmerController::class, 'deleteVegetable'])->name('api:delete_vegetable');
        Route::post('/add_trees', [FarmerController::class, 'addTrees'])->name('api:add_trees');
        Route::post('/delete_tree', [FarmerController::class, 'deleteTree'])->name('api:delete_tree');
        Route::get('/get_vegetables', [FarmerController::class, 'getVegetables'])->name('api:get_vegetables');
        Route::get('/get_trees', [FarmerController::class, 'getTrees'])->name('api:get_trees');
        Route::post('/create_box', [FarmerController::class, 'createBox'])->name('api:create_box');
        Route::post('/add_items', [FarmerController::class, 'addItems'])->name('api:add_items');
	});

    Route::get('/user_profile', [AuthController::class, 'userProfile'])->name('api:user_profile');
	Route::post('/user_get_vegetables', [UserController::class, 'userGetVegetables'])->name('api:user_get_vegetables');
    Route::post('/user_get_trees', [UserController::class, 'userGetTrees'])->name('api:user_get_trees');
    Route::post('/user_adopt_trees', [UserController::class, 'userAdoptTrees'])->name('api:user_adopt_trees');
    Route::post('/user_get_boxes', [UserController::class, 'userGetBoxes'])->name('api:user_get_boxes');
    Route::post('/user_get_items', [UserController::class, 'userGetItems'])->name('api:user_get_items');
    Route::post('/user_order_boxes', [UserController::class, 'userOrderBoxes'])->name('api:user_order_boxes');
    Route::post('/user_create_box', [UserController::class, 'userCreateBox'])->name('api:user_create_box');
    Route::post('/user_add_items', [UserController::class, 'userAddItems'])->name('api:user_add_items');
});