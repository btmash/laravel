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


Route::middleware('auth.basic.once')->group(function() {
  Route::get('notes', 'NoteController@list');
  Route::get('notes/{id}', 'NoteController@show');
  Route::post('notes', 'NoteController@create');
  // I removed this because nginx did not like put/patch requests. Otherwise, I would be using put/patch.
  // Route::patch('notes/{id}', 'NoteController@update');
  // I added this because nginx did not like put/patch requests. Otherwise, I would be using put/patch.
  Route::post('notes/{id}', 'NoteController@update');
  Route::delete('notes/{id}', 'NoteController@delete');
});
