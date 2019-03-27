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

Route::get('/', function () {
    return view('auth.login');
});
Route::post('/adminlogin', 'LoginController@adminLogin')->name('adminLogin');

Auth::routes();

// route with middleware on controller 

Route::group(['middleware' =>'adminAuth','prefix' => 'admin'], function(){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/about', 'HomeController@about')->name('about');
    Route::get('/members', 'HomeController@members')->name('members');
    Route::post('/members/add', 'HomeController@addmembers')->name('addmembers');
    Route::post('/deletemember', 'HomeController@deletemember')->name('deletemember');
    Route::post('/members/edit', 'HomeController@editmembers')->name('editmembers');
    Route::get('/regions', 'HomeController@regions')->name('regions');
    Route::get('/regions/{regionname}', 'HomeController@viewregions')->name('viewregions');
    Route::get('/clubs', 'HomeController@clubs')->name('clubs');
    Route::get('/clubs/{clubname}', 'HomeController@viewclub')->name('viewclub');
    Route::get('/memberssearch', 'HomeController@memberssearch')->name('memberssearch');
    Route::get('/regionsearch', 'HomeController@regionsearch')->name('regionsearch');
    Route::get('/clubsearch', 'HomeController@clubsearch')->name('clubsearch');
    Route::post('/updateaccount', 'HomeController@updateaccount')->name('updateaccount');
    Route::get('/downloadExcel/{type}', 'HomeController@downloadExcel')->name('downloadExcel');
    
});
// end route with middleware