<?php

namespace Modules\V1\Middleware;

use LucaDegasperi\OAuth2Server\Middleware\OAuthMiddleware;
use Closure;
use Request;
use League\OAuth2\Server\Exception\AccessDeniedException;

class Oauth extends OAuthMiddleware {

    public function handle($request, Closure $next, $scopesString = null) {

        $scopes = [];

        if (!is_null($scopesString)) {
            $scopes = explode('+', $scopesString);
        }

        $this->authorizer->setRequest($request);

        $this->authorizer->validateAccessToken($this->httpHeadersOnly);

        $this->validateSign();

        $this->validateScopes($scopes);
        return $next($request);
    }

    protected function validateSign() {

        $time = Request::get('t');

        if (!$time) {
            throw new AccessDeniedException();
        }

        $token = $this->authorizer->getAccessToken()->getId();

        if (!$token) {
            throw new AccessDeniedException();
        }

        $sign = Request::get('sign', null);
        if (!$sign) {
            throw new AccessDeniedException();
        }
        
        //除sign参数外
        $data = [
            't' => $time,
            'access_token' => $token
        ];
        $data = array_merge($data, Request::all());
        unset($data['sign']);
        ksort($data);
        $str = [];
        foreach ($data as $key => $value) {
            $str[] = $key . '=' . $value;
        }
        
        $appId = $this->authorizer->getClientId();
        $hash = base64_encode(hash_hmac("sha1", implode('&', $str), $appId, true));

        if (Request::get('sign') != $hash) {
            throw new AccessDeniedException();
        }
    }

}
