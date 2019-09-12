<?php

use Illuminate\Http\Request;

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

Route::middle('auth.basic:api')->group(function() {
  Route::get('notes', 'NoteController@list');
  Route::get('notes/{id}', 'NoteController@show');
  Route::post('notes', 'NoteController@create');
  Route::patch('notes/{id}', 'NoteController@update');
  Route::delete('notes/{id}', 'NoteController@delete');
});
