<?php

Route::group(['middleware' => 'web', 'prefix' => 'department', 'namespace' => 'Modules\Department\Http\Controllers'], function()
{
    Route::get('/', 'DepartmentController@index');
});