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
Route::post('/userlogin', 'LoginController@userLogin')->name('userLogin');

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
    Route::get('/uploads', 'HomeController@uploads')->name('uploads');
    Route::post('/prouploads', 'HomeController@prouploads')->name('prouploads');
    
    Route::get('/clubs', 'HomeController@clubs')->name('clubs');
    Route::get('/clubs/{clubname}', 'HomeController@viewclub')->name('viewclub');
    Route::get('/memberssearch', 'HomeController@memberssearch')->name('memberssearch');
    Route::get('/regionsearch', 'HomeController@regionsearch')->name('regionsearch');
    Route::get('/clubsearch', 'HomeController@clubsearch')->name('clubsearch');
    Route::post('/updateaccount', 'HomeController@updateaccount')->name('updateaccount');
    Route::get('/import', 'HomeController@import')->name('import');
    Route::post('/importmembers', 'HomeController@importmembers')->name('importmembers');
    Route::get('/export', 'HomeController@export')->name('export');
    Route::post('/export/custom', 'HomeController@exportcustom')->name('exportcustom');
    Route::get('/downloadExcel/{type}', 'HomeController@downloadExcel')->name('downloadExcel');
    
});

Route::group(['middleware' =>'assistantAuth','prefix' => 'assistant'], function(){
    Route::get('/home', 'AssistantController@index')->name('home');
    Route::get('/members', 'AssistantController@members')->name('members');
    Route::post('/members/add', 'AssistantController@addmembers')->name('addmembers');
    Route::post('/members/edit', 'AssistantController@editmembers')->name('editmembers');
    Route::get('/regions', 'AssistantController@regions')->name('regions');
    Route::get('/regions/{regionname}', 'AssistantController@viewregions')->name('viewregions');
    Route::get('/clubs', 'AssistantController@clubs')->name('clubs');
    Route::get('/clubs/{clubname}', 'AssistantController@viewclub')->name('viewclub');
    Route::get('/memberssearch', 'AssistantController@memberssearch')->name('memberssearch');
    Route::get('/regionsearch', 'AssistantController@regionsearch')->name('regionsearch');
    Route::get('/clubsearch', 'AssistantController@clubsearch')->name('clubsearch');
    Route::post('/updateaccount', 'AssistantController@updateaccount')->name('updateaccount');
    Route::get('/downloadExcel/{type}', 'AssistantController@downloadExcel')->name('downloadExcel');   
});
// end route with middleware