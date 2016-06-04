<?php

namespace DingTalk\Api;

use DingTalk\Util\TokenCache;
use DingTalk\Util\Http;

class Auth {

    public static function getAccessToken() {
        /**
         * 缓存accessToken。accessToken有效期为两小时，需要在失效前请求新的accessToken（注意：以下代码没有在失效前刷新缓存的accessToken）。
         */
        $accessToken = TokenCache::get('corp_access_token');
        if (!$accessToken) {
            $response = Http::get('/gettoken', array('corpid' => env('DING_TALK_CORPID'), 'corpsecret' => env('DING_TALK_SECRET')));
            $accessToken = $response->access_token;
            TokenCache::set('corp_access_token', $accessToken);
        }
        return $accessToken;
    }

    /**
     * 缓存jsTicket。jsTicket有效期为两小时，需要在失效前请求新的jsTicket（注意：以下代码没有在失效前刷新缓存的jsTicket）。
     */
    public static function getTicket($accessToken) {
        $jsticket = TokenCache::getJsTicket('js_ticket');
        if (!$jsticket) {
            $response = Http::get('/get_jsapi_ticket', array('type' => 'jsapi', 'access_token' => $accessToken));
            self::check($response);
            $jsticket = $response->ticket;
            TokenCache::setJsTicket($jsticket);
        }
        return $jsticket;
    }

    static function curPageURL() {
        $pageURL = 'http';

        if (array_key_exists('HTTPS', $_SERVER) && $_SERVER["HTTPS"] == "on") {
            $pageURL .= "s";
        }
        $pageURL .= "://";

        if ($_SERVER["SERVER_PORT"] != "80") {
            $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
        } else {
            $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
        }
        return $pageURL;
    }

    public static function getConfig() {
        $corpId = env('DING_TALK_OAPI_CORPID');
        $agentId = env('DING_TALK_OAPI_AGENTID');
        $nonceStr = 'abcdefg';
        $timeStamp = time();
        $url = self::curPageURL();
        $corpAccessToken = self::getAccessToken();
        if (!$corpAccessToken) {
            Log::error("[getConfig] ERR: no corp access token");
        }
        $ticket = self::getTicket($corpAccessToken);
        $signature = self::sign($ticket, $nonceStr, $timeStamp, $url);

        $config = array(
            'url' => $url,
            'nonceStr' => $nonceStr,
            'agentId' => $agentId,
            'timeStamp' => $timeStamp,
            'corpId' => $corpId,
            'signature' => $signature);
        return json_encode($config, JSON_UNESCAPED_SLASHES);
    }

    public static function sign($ticket, $nonceStr, $timeStamp, $url) {
        $plain = 'jsapi_ticket=' . $ticket .
                '&noncestr=' . $nonceStr .
                '&timestamp=' . $timeStamp .
                '&url=' . $url;
        return sha1($plain);
    }

    static function check($res) {
        if ($res->errcode != 0) {
            Log::error("FAIL: " . json_encode($res));
            exit("Failed: " . json_encode($res));
        }
    }

}
