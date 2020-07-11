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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix('exercice')->group(function(){
	Route::get('index','ExerciceController@index')->name('exercice.index');
	Route::post('store','ExerciceController@store')->name('exercice.store');
	Route::get('show/{id}','ExerciceController@index')->name('exercice.show');

});
Route::prefix('classe')->group(function(){
	Route::get('index','ClasseController@index')->name('classe.index');
	Route::post('store','ClasseController@index')->name('classe.store');
	Route::get('show/{id}','ClasseController@index')->name('classe.show');

});
