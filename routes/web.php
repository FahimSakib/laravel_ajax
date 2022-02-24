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
