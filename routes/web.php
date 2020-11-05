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
 Route::group(['middleware' => 'auth'], function () {
     
Route::get('/home', 'HomeController@index')->name('home');
Route::resource('/categories','categoriescontroller' );
Route::resource('/tags','tagcontroller' );
Route::resource('/posts', 'postscontroller');
Route::get('/trushed-posts','postscontroller@trushed')->name('trushed.index');
Route::get('/trushed-posts/{id}','postscontroller@restore')->name('trushed.restore');
     
 });
 Route::middleware(['auth','admin'])->group( function () {
     
Route::get('/users','userscontroller@index')->name('users.index');
Route::post('/users/{users}/make-admin','userscontroller@makeadmin')->name('users.make-admin');
 });