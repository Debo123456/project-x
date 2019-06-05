<?php

use App\Cars\CarsRepository;
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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/view-car/{id}', 'CarController@index')->where('id', '[0-9]+');
Route::get('/{user}/my-cars', 'CarController@myCar')->middleware('auth');
Route::get('/{user}/delete-car/{id}', 'CarController@deleteCar')->middleware('auth');
Route::get('/{user}/update-car/{id}', 'CarUpdateController@index')->middleware('auth');
Route::get('/{user}/view-car/{id}', 'CarController@viewMyCar')->middleware('auth');

Route::get('/{user}/delete-image/{id}', 'CarUpdateController@deleteImage')->middleware('auth');
Route::get('/{user}/set-display-image/{id}', 'CarUpdateController@setDisplayImage')->middleware('auth');
Route::post('/{user}/update-images/{id}', 'CarUpdateController@updateImages')->middleware('auth');
Route::post('/{user}/update-car/{id}', 'CarUpdateController@updateCar')->middleware('auth');

Route::get('/contact', 'ContactController@displayForm')->name('contact');
Route::post('/contact', 'ContactController@sendEmail');

Auth::routes();
Route::get('/upload', 'UploadController@showUploadForm')->name('upload')->middleware('auth');
Route::post('/upload', 'UploadController@upload');

Route::get('/search', 'HomeController@search');
Route::get('/filter-search', 'HomeController@filterSearch');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/update-view', 'ViewController@incrementView');

