<?php

namespace Modules\V1\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Request;
use Authorizer;

class AuthController extends Controller {

    function getAuthorize() {

        $authParams = Authorizer::getAuthCodeRequestParams();

        $formParams = array_except($authParams, 'client');

        $formParams['client_id'] = $authParams['client']->getId();

        $formParams['scope'] = implode(config('oauth2.scope_delimiter'), array_map(function ($scope) {
                    return $scope->getId();
                }, $authParams['scopes']));

        return View::make('v1::.authorization-form', ['params' => $formParams, 'client' => $authParams['client']]);
    }

    public function postAuthorize() {
        
        $params = Authorizer::getAuthCodeRequestParams();

        $user    = Auth::guard('admin')->login([
            'email'     =>'chendehua@xin-group.com',
            'password'  => 123456
        ]);
        
        $params['user_id']  = $user->id;
        
        $redirectUri = $params['redirect_uri'];

        // If the user has allowed the client to access its data, redirect back to the client with an auth code.
        if (Request::has('approve')) {
            $redirectUri = Authorizer::issueAuthCode('user', $params['user_id'], $params);
        }

        // If the user has denied the client to access its data, redirect back to the client with an error message.
        if (Request::has('deny')) {
            $redirectUri = Authorizer::authCodeRequestDeniedRedirectUri();
        }

        return Redirect::to($redirectUri);
    }
    
    public function postAccessToken(){
        return response()->json(Authorizer::issueAccessToken());
    }
    
    public function getUser(){
        dd(Request::getClientIp());
    }

}
