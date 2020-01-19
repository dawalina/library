<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/', 'welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Authors
Route::get('/authors', 'AuthorController@index')->name('author.index');
Route::get('/authors/{id}', 'AuthorController@view')->name('author.view');
Route::post('/authors/edit/{id}', 'AuthorController@edit')->name('author.edit');
Route::post('/authors/create', 'AuthorController@create')->name('author.create');

//Books
Route::get('/books', 'BookController@index')->name('book.index');
Route::get('/books/{id}', 'BookController@view')->name('book.view');
Route::post('/books/edit/{id}', 'BookController@edit')->name('book.edit');
Route::get('/books/removeCopy/{id}/{copyId}', 'BookController@removeCopy')->name('book.copy.remove');
Route::get('/books/addCopy/{id}/{copyId}', 'BookController@addCopy')->name('book.copy.add');
Route::post('/books/createCopy/{id}', 'BookController@createCopy')->name('book.copy.create');
Route::get('/books/removeAuthor/{id}/{authorId}', 'BookController@removeAuthor')->name('book.author.remove');
Route::post('/books/addAuthor/{id}', 'BookController@addAuthor')->name('book.author.add');

Route::get('/books/getItems', 'BookController@getItems')->name('book.getItems');

//Readers
Route::get('/readers', 'ReaderController@index')->name('reader.index');
Route::get('/readers/{id}', 'ReaderController@view')->name('reader.view');
Route::post('/readers/edit/{id}', 'ReaderController@edit')->name('reader.edit');
Route::post('/readers/create', 'ReaderController@create')->name('reader.create');

//Rents
Route::get('/rents', 'RentController@index')->name('rent.index');
Route::get('/rents/{id}', 'RentController@view')->name('rent.view');
Route::post('/rents/edit/{id}', 'RentController@edit')->name('rent.edit');
Route::post('/rents/create', 'RentController@create')->name('rent.create');

//Report
Route::get('/report', 'ReportController@index')->name('report.index');
Route::post('/report', 'ReportController@index')->name('report.index');
