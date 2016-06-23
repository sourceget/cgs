<?php

Route::group(['middleware' => 'web', 'prefix' => 'logistic', 'namespace' => 'Modules\Logistic\Http\Controllers'], function()
{
    Route::get('/', 'LogisticController@index');
});