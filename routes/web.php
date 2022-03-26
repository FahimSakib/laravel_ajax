<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//ajax-js-practice:

Route::get('ajax', function () {
    $data = "<h2>Changed with ajax/javascripts</h2>";
    return response($data);
});

Route::post('ajax-post','JavaScriptController@ajax_post')->name('ajax.post');
Route::get('javascript','JavaScriptController@index');

Route::group(['prefix' => 'jquery' ,'as' => 'jquery.'], function(){
    Route::get('index','JqueryController@index')->name('ajax.index');
    Route::get('ajax/get','JqueryController@ajax_get')->name('ajax.get');
    Route::post('ajax/post','JqueryController@ajax_post')->name('ajax.post');
});

Route::view('json','json');

//end ajax-js-practice

//ajax-crud start:


Route::get('crud','CrudIndexController@index');
Route::post('upazila-list','CrudIndexController@upazila_lsit')->name('upazila.list');

Route::group(['prefix' => 'user', 'as' => 'user.'], function(){
    Route::post('store','CrudIndexController@store')->name('store');
    Route::post('list','CrudIndexController@userList')->name('list');
    Route::post('edit','CrudIndexController@userEdit')->name('edit');
    Route::post('show','CrudIndexController@userShow')->name('show');
});
