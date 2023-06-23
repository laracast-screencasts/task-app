<?php

use Illuminate\Http\Request;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('login', 'App\Http\Controllers\API\UserController@login');
Route::post('register', 'App\Http\Controllers\API\UserController@register');
Route::group(['middleware' => 'auth:api'], function(){
    Route::post('details', 'App\Http\Controllers\API\UserController@details');
});
Route::post('create', 'App\Http\Controllers\API\TaskController@create');
Route::get('list', 'App\Http\Controllers\API\TaskController@index');
Route::get('show/{id}', 'App\Http\Controllers\API\TaskController@show');