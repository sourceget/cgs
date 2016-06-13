<?php

namespace App\Http\Controllers;
use Baidu\Sdk\BaiduOAuth;
use Request;
use Session;
use Baidu\Sdk\BaiduPCS;

class BaiduController extends Controller
{
    public function index(){
        //http://cgs.xincap.com/oauth/baidu/
        $clientId   = env('BAIDU_KEY');
        $clientSecret   = env('BAIDU_SECRET');
        $redirectUri   = env('BAIDU_REDIRECT');
        $oauth  = new BaiduOAuth($clientId, $clientSecret);
        $oauth->setRedirectUri($redirectUri);
        if(!Request::has('code') || !Request::get('code')){
            $url    = $oauth->getAuthorizeUrl();
            return redirect($url);
        }
        $code   = Request::get('code');
        $token  = $oauth->getAccessTokenByAuthorizationCode($code);
        if(is_array($token)){
            Session::pull('sdk_baidu', $token);
            return response($token['access_token']);
        }
        return response('failed.');
    }
    
    public function files(){
        $token  = env('baidu_token');
        $pcs    = new BaiduPCS($token);
        $ret    = $pcs->listOfflineDownloadTask(0,50);
        print_r($ret);
    }
}
