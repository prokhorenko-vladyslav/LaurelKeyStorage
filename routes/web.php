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

Route::middleware('auth')->group(function() {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/key/{userId}/{keyId}/file', function ($userId, $keyId) {
        $key = \Illuminate\Support\Facades\Auth::user()->keys()->find($keyId);
        if (!$key) {
            return abort(404);
        }
        return response()->download(storage_path() . '/app/' . $key->filepath);
    })->name('key.file');
    Route::resource('/key', 'KeyController');
});
