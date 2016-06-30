<?php

Route::group(['middleware' => 'oauth','prefix' => 'oauth', 'namespace' => 'Modules\V1\Http\Controllers'], function()
{
    
    Route::get('v1/authorize', ['as' => 'oauth.authorize.get', 'middleware' => ['check-authorization-params'], "AuthController@getAuthorize"]);
    
    Route::post('v1/authorize', ['as' => 'oauth.authorize.post', 'middleware' => ['check-authorization-params'], 'AuthController@postAuthorize']);

    Route::post('v1/access_token',['as' => 'oauth.aceess_token.post'], 'AuthController@postAccessToken');
    
});

Route::group(['middleware' => 'oauth_api', 'prefix' => 'api/v1','namespace' => 'Modules\V1\Http\Controllers'], function()
{
    Route::get('user', 'AuthController@getUser');

});

