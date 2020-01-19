<?php

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

Route::group(['prefix' => 'v1'], function () {
    Route::post('/login', 'Api\v1\AuthController@login')->name('login');
});

Route::group(['prefix' => 'v1', 'middleware' => 'auth:api'], function () {
    Route::post('/logout', 'Api\v1\AuthController@logout')->name('logout');

    Route::get('/authors', 'Api\v1\AuthorController@index')->name('authors');
    Route::get('/authors/{id}', 'Api\v1\AuthorController@show')->name('authors.show');
    Route::put('/authors/{id}', 'Api\v1\AuthorController@edit')->name('authors.edit');
    Route::post('/authors', 'Api\v1\AuthorController@create')->name('authors.create');
    Route::delete('/authors/{id}', 'Api\v1\AuthorController@delete')->name('authors.delete');
});
