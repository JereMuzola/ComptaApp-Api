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

Route::group(['prefix'=>'classe','middleware'=>'cors'],function(){
	Route::get('index','ClasseController@index')->name('classe.index');
	Route::post('store','ClasseController@store')->name('classe.store');
	Route::get('show/{code}','ClasseController@show')->name('classe.show');
});
Route::group(['prefix'=>'sorteCompte','middleware'=>'cors'],function (){
   Route::get('index','SorteCompteController@index')->name('sorte.index');
});

Route::group(['prefix'=>'typeCompte','middleware'=>'cors'],function (){
   Route::get('index','TypeCompteController@index')->name('type.index');
});

Route::prefix('compte')->group(function(){
	Route::get('index','CompteController@index')->name('compte.index');
	Route::post('store','CompteController@store')->name('compte.store');
	Route::get('show/{numero}','CompteController@show')->name('compte.show');
    Route::post('update','CompteController@update')->name('compte.update');
});

Route::prefix('compteDiv')->group(function (){
    Route::get('index','CompteDivController@index')->name('compteDiv.index');
    Route::post('store','CompteDivController@store')->name('compteDiv.store')->where('numero','[0-9]+');
    Route::get('show/{numero}','CompteDivController@show')->name('compteDiv.show');

});
Route::prefix('sousCompte')->group(function (){
    Route::get('index','SousCompteController@index')->name('sousCompte.index');
    Route::post('store','SousCompteController@store')->name('sousCompte.store');
    Route::get('show/{numero}','SousCompteController@show')->name('sousCompte.show');
});
Route::prefix('operation')->group(function (){
    Route::get('index','OperationController@index')->name('Operation.index');
    Route::post('store','OperationController@store')->name('Operation.store');
    Route::get('show/{numero}','OperationController@show')->name('Operation.show');
    Route::get('journals','OperationController@journals')->name('Operation.journals');
});
