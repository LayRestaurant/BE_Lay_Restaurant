<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FoodController;

Route::get('/foods', [FoodController::class, 'index']);
Route::get('/foods/filter/{price}', [FoodController::class, 'filter']);
Route::get('/foods/prices', [FoodController::class, 'getAllPrice']);
Route::get('/foods/types', [FoodController::class, 'getAllType']);
Route::get('/foods/types/{type}', [FoodController::class, 'getFoodByType']);
Route::get('/foods/sort/{type}', [FoodController::class, 'sortByPrice']);
Route::get('/admin/foods', [FoodController::class, 'adminIndex']);
Route::get('/foods/{id}', [FoodController::class, 'show']);
Route::get('/foods/{id}/edit', [FoodController::class, 'getForUpdate']);
Route::delete('/foods/{id}', [FoodController::class, 'destroy']);
Route::post('/foods', [FoodController::class, 'create']);
Route::put('/foods/{id}', [FoodController::class, 'update']);
Route::post('/foods/search', [FoodController::class, 'search']);

