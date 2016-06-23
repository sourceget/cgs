<?php

Route::group(['middleware' => 'web', 'prefix' => 'work_flow', 'namespace' => 'Modules\WorkFlow\Http\Controllers'], function()
{
    Route::get('/', 'WorkFlowController@index');
});