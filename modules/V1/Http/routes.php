<?php

Route::group(['middleware' => 'oauth', 'prefix' => 'oauth', 'namespace' => 'Modules\V1\Http\Controllers'], function()
{
    Route::get('/', 'V1Controller@index');
    
    Route::get('v1/authorize', ['as' => 'oauth.authorize.get', 'middleware' => ['check-authorization-params'], "AuthController@getAuthorize"]);
    
    Route::post('v1/authorize', ['as' => 'oauth.authorize.post', 'middleware' => ['check-authorization-params'], 'AuthController@postAuthorize']);

    Route::post('v1/access_token',['as' => 'oauth.aceess_token.post'], 'AuthController@postAccessToken');
    
});