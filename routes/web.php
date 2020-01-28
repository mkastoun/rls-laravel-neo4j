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
    'prefix' => 'folder/{folderUuid}'
], function () {
    Route::get('/access', 'FolderController@access')->name('folderAccess');
    Route::get('/items', 'FolderController@items')->name('folderItems');
});

Route::group([
    'prefix' => 'folder/{folderUuid}/item'
], function () {
    Route::post('/', 'ItemController@store')->name('itemStore');
});

Route::resource('team', 'TeamController');
Route::post('employee/orphan', 'EmployeeController@storeOrphanEmployee');

Route::group([
    'prefix' => 'team/{teamUuid}'
], function () {
    Route::post('/employee', 'EmployeeController@store')->name('addTeamEmployee');
    Route::get('/employee', 'TeamController@employees')->name('teamEmployees');
    Route::get('/folders', 'TeamController@folders')->name('teamFolders');
    Route::get('/items', 'TeamController@items')->name('teamItems');
    Route::get('/access', 'TeamController@access')->name('teamAccess');
});

Route::group([
    'prefix' => 'employee/{employeeUuid}'
], function () {
    Route::get('/', 'EmployeeController@show');
    Route::get('/folders', 'EmployeeController@folders')->name('employeeFolders');
    Route::get('/items', 'EmployeeController@items')->name('employeeItems');
    Route::get('/access', 'EmployeeController@access')->name('employeeAccess');
    Route::get('/team', 'EmployeeController@team')->name('employeeTeam');
    Route::get('/team/items', 'EmployeeController@teamItems')->name('employeeTeamItems');
});

Route::resource('access-level', 'AccessLevelController');

Route::group([
    'prefix' => 'access/{accessUuid}/'
], function () {
    Route::get('access-no-employee', 'AccessLevelController@employeeWithoutAccess')->name('employeeWithNoAccess');
    Route::get('access-no-team', 'AccessLevelController@teamWithNoAccess')->name('teamWithNoAccess');
    Route::get('access-no-folder', 'AccessLevelController@folderWithNoAccess')->name('folderWithNoAccessSelect');
    Route::get('access-no-item', 'AccessLevelController@itemWithNoAccess')->name('itemWithNoAccessSelect');
    Route::group([
        'prefix' => 'team/{teamUuid}'
    ], function () {
        Route::post('/', 'AccessTeamController@store');
        Route::put('/', 'AccessTeamController@update');
    });
    Route::group([
        'prefix' => 'folder/{folderUuid}'
    ], function () {
        Route::resource('/', 'AccessFolderController');
    });
    Route::group([
        'prefix' => 'item/{itemUuid}'
    ], function () {
        Route::resource('/', 'AccessItemController');
    });
    Route::group([
        'prefix' => 'employee/{employeeUuid}'
    ], function () {
        Route::post('/', 'AccessEmployeeController@store')->name('assignAccessToEmployee');
    });
});

Route::group([
    'prefix' => 'admin'
], function () {
    Route::get('/employee', 'FrontEndController@index')->name('frontEndEmployee');
    Route::get('/employee/{employeeUuid}/details', 'FrontEndController@employeeDetails')->name('frontEndEmployeeDetails');
    Route::get('/team', 'FrontEndController@create')->name('frontEndTeam');
    Route::get('/team/{teamUuid}/details', 'FrontEndController@teamDetails')->name('frontEndTeamDetails');
    Route::get('/folder', 'FrontEndController@folder')->name('frontEndFolder');
    Route::get('/folder/{folderUuid}/details', 'FrontEndController@folderDetails')->name('frontEndFolderDetails');
    Route::get('/access', 'FrontEndController@access')->name('frontEndAccess');
    Route::get('/access/{accessUuid}/details', 'FrontEndController@accessDetails')->name('frontEndAccessDetails');
});

