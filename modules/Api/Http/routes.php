<?php

Route::group(['middleware' => 'api', 'prefix' => 'api', 'namespace' => 'Modules\Api\Http\Controllers'], function() {
    Route::get('/user/list', 'ApiController@index');
});
