<?php

Route::group(['middleware' => 'web', 'prefix' => 'baidu', 'namespace' => 'Modules\Baidu\Http\Controllers'], function()
{
    Route::get('/', 'BaiduController@index');
});