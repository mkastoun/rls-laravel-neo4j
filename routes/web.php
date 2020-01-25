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
    return view('welcome');
});

Route::resource('folder', 'FolderController');
Route::group([
    'prefix' => 'folder/{folderUuid}/item'
], function () {
    Route::resource('/', 'ItemController');
});

Route::resource('team', 'TeamController');
Route::get('employee/{employeeUuid}', 'EmployeeController@show');
Route::group([
    'prefix' => 'team/{teamUuid}/employee'
], function () {
    Route::post('/', 'EmployeeController@store');
});

Route::resource('access-level', 'AccessLevelController');


Route::group([
    'prefix' => 'access/{accessUuid}/employee/{employeeUuid}'
], function () {
    Route::resource('/', 'AccessEmployeeController');
});

Route::group([
    'prefix' => 'access/{accessUuid}/item/{itemUuid}'
], function () {
    Route::resource('/', 'AccessItemController');
});

Route::group([
    'prefix' => 'access/{accessUuid}/folder/{folderUuid}'
], function () {
    Route::resource('/', 'AccessFolderController');
});

Route::group([
    'prefix' => 'access/{accessUuid}/team/{teamUuid}'
], function () {
    Route::resource('/', 'AccessTeamController');
});

Route::group([
    'prefix' => 'admin'
], function () {
    Route::get('/employee', 'FrontEndController@index');
    Route::get('/team', 'FrontEndController@create');
});

