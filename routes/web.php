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
    Route::get('/', 'ItemController@index')->name('itemStore');
});

Route::resource('team', 'TeamController');
Route::post('employee/orphan', 'EmployeeController@storeOrphanEmployee');
Route::get('employee/orphan', 'EmployeeController@getOrphanEmployee')->name('orphanEmployeeList');

Route::group([
    'prefix' => 'team/{teamUuid}'
], function () {
    Route::post('/employee', 'EmployeeController@store')->name('addTeamEmployee');
    Route::post('/employee-orphan/{employeeUuid}', 'TeamController@addOrphanEmployeeToTeam')->name('addTeamOrphanEmployee');
    Route::get('/employee', 'TeamController@employees')->name('teamEmployees');
    Route::get('/folders', 'TeamController@folders')->name('teamFolders');
    Route::get('/items', 'TeamController@items')->name('teamItems');
    Route::get('/access', 'TeamController@access')->name('teamAccess');
    Route::delete('/employee/{employeeUuid}', 'TeamController@detachEmployee')->name('detachEmployeeFromTeam');
});

Route::group([
    'prefix' => 'employee/{employeeUuid}'
], function () {
    Route::get('/', 'EmployeeController@show');
    Route::get('/details', 'EmployeeController@getEmployeeInfo')->name('employeeShow');;
    Route::get('/folders', 'EmployeeController@folders')->name('employeeFolders');
    Route::get('/items', 'EmployeeController@items')->name('employeeItems');
    Route::get('/access', 'EmployeeController@access')->name('employeeAccess');
    Route::get('/team', 'EmployeeController@team')->name('employeeTeam');
    Route::get('/team/items', 'EmployeeController@teamItems')->name('employeeTeamItems');
    Route::get('/team/folder', 'EmployeeController@folderItems')->name('employeeFolderItems');
});

Route::resource('access-level', 'AccessLevelController');

Route::group([
    'prefix' => 'access/{accessUuid}/'
], function () {
    Route::get('access-no-employee', 'AccessEmployeeController@employeeWithoutAccess')->name('employeeWithNoAccess');
    Route::get('access-no-team', 'AccessTeamController@teamWithNoAccess')->name('teamWithNoAccess');
    Route::get('access-no-folder', 'AccessFolderController@folderWithNoAccess')->name('folderWithNoAccessSelect');
    Route::get('access-no-item', 'AccessItemController@itemWithNoAccess')->name('itemWithNoAccessSelect');
    Route::group([
        'prefix' => 'team/{teamUuid}'
    ], function () {
        Route::post('/', 'AccessTeamController@store');
        Route::put('/', 'AccessTeamController@update');
        Route::delete('/', 'AccessTeamController@revokeTeamAccess')->name('revokeTeamAccess');
    });
    Route::group([
        'prefix' => 'folder/{folderUuid}'
    ], function () {
        Route::post('/', 'AccessFolderController@store');
        Route::delete('/', 'AccessFolderController@destroy');
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
        Route::delete('/', 'AccessEmployeeController@revokeEmployeeAccess')->name('revokeEmployeeAccess');
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

