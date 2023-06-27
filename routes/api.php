<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::namespace('App\Http\Controllers\Api')->group(function () {
  Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'AuthController@login');
    Route::get('maintenance', 'AuthController@maintenance');
  });
  Route::group(['middleware' => 'auth:api'], function () {
    Route::group(['prefix' => 'auth'], function () {
      Route::post('change-password/{id}', 'AuthController@changePassword');
      Route::get('info/{id}', 'AuthController@info');
    });

    Route::group(['prefix' => 'announcement'], function() {
      Route::get('/latest', 'AnnouncementController@latest');
      Route::get('/{id}', 'AnnouncementController@show');
      Route::get('/', 'AnnouncementController@index');
    });

    Route::group(['prefix' => 'villager'], function() {
      Route::get('/family/{id}', 'VillagerController@family');
      Route::get('/{id}', 'VillagerController@show');
      Route::get('/', 'VillagerController@index');
    });

    Route::group(['prefix' => 'family'], function() {
      Route::get('/{id}', 'FamilyController@show');
      Route::get('/', 'FamilyController@index');
    });
  });
});
