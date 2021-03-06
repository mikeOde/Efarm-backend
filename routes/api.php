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
        Route::get('/profile', [FarmerController::class, 'getProfile'])->name('api:profile');
        Route::post('/edit_profile', [FarmerController::class, 'editProfile'])->name('api:edit_profile');
        Route::post('/add_vegetables', [FarmerController::class, 'addVegetables'])->name('api:add_vegetables');
        Route::post('/edit_vegetable', [FarmerController::class, 'editVegetable'])->name('api:edit_vegetable');
		Route::post('/delete_vegetable', [FarmerController::class, 'deleteVegetable'])->name('api:delete_vegetable');
        Route::post('/add_trees', [FarmerController::class, 'addTrees'])->name('api:add_trees');
        Route::post('/edit_tree', [FarmerController::class, 'editTree'])->name('api:edit_tree');
        Route::post('/delete_tree', [FarmerController::class, 'deleteTree'])->name('api:delete_tree');
        Route::get('/get_vegetables', [FarmerController::class, 'getVegetables'])->name('api:get_vegetables');
        Route::get('/get_trees', [FarmerController::class, 'getTrees'])->name('api:get_trees');
        Route::get('/get_customers', [FarmerController::class, 'getCustomers'])->name('api:get_customers');
        Route::get('/trees_chart', [FarmerController::class, 'treesChartData'])->name('api:trees_chart');
        Route::get('/vegetables_chart', [FarmerController::class, 'vegetablesChartData'])->name('api:vegetables_chart');
        Route::get('/total_adoptions', [FarmerController::class, 'totalAdoptionsData'])->name('api:total_adoptions');
        Route::get('/total_orders', [FarmerController::class, 'totalOrdersData'])->name('api:total_orders');
	});

    Route::get('/user_get_farms', [UserController::class, 'userGetFarms'])->name('api:user_get_farms');
    Route::get('/get_all_trees', [UserController::class, 'getAllTrees'])->name('api:get_all_trees');
    Route::get('/get_all_vegetables', [UserController::class, 'getAllVegetables'])->name('api:get_all_vegetables');
	Route::post('/user_get_vegetables', [UserController::class, 'userGetVegetables'])->name('api:user_get_vegetables');
    Route::post('/user_get_trees', [UserController::class, 'userGetTrees'])->name('api:user_get_trees');
    Route::post('/user_adopt_trees', [UserController::class, 'userAdoptTrees'])->name('api:user_adopt_trees');
    Route::get('/user_get_adoptions', [UserController::class, 'userGetAdoptions'])->name('api:user_get_adoptions');
    Route::post('/user_order_vegetables', [UserController::class, 'userOrderVegetables'])->name('api:user_order_vegetables');
    Route::get('/user_get_orders', [UserController::class, 'userGetOrders'])->name('api:user_get_orders');
});
