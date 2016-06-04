<?php

namespace DingTalk\Util;

use Cache;

class TokenCache {

    public static function setSuiteTicket($ticket) {
        Cache::put(config("ding_talk.prefix")."suite_ticket", $ticket);
    }

    public static function getSuiteTicket() {
        return Cache::get(config("ding_talk.prefix")."suite_ticket");
    }

    public static function setJsTicket($ticket) {
        Cache::put(config("ding_talk.prefix")."js_ticket", $ticket, 0, time() + 7000); // js ticket有效期为7200秒，这里设置为7000秒
    }

    public static function getJsTicket() {
        return Cache::get(env("ding_talk.prefix")."js_ticket");
    }

    public static function setSuiteAccessToken($accessToken) {
        Cache::put(config("ding_talk.prefix")."suite_access_token", $accessToken, 0, time() + 7000); // suite access token有效期为7200秒，这里设置为7000秒
    }

    public static function getSuiteAccessToken() {
        return Cache::get(config("ding_talk.prefix")."suite_access_token");
    }

    public static function setCorpAccessToken($accessToken) {
        Cache::put(config("ding_talk.prefix")."corp_access_token", $accessToken, 0, time() + 7000); // corp access token有效期为7200秒，这里设置为7000秒
    }

    public static function getCorpAccessToken() {

        return Cache::get(config("ding_talk.prefix")."corp_access_token");
    }

    public static function setIsvCorpAccessToken($accessToken) {

        Cache::set(config("ding_talk.prefix")."isv_corp_access_token", $accessToken, 0, time() + 7000); // corp access token有效期为7200秒，这里设置为7000秒
    }

    public static function getIsvCorpAccessToken() {

        return Cache::get(config("ding_talk.prefix")."isv_corp_access_token");
    }

    public static function setTmpAuthCode($tmpAuthCode) {

        Cache::set(config("ding_talk.prefix")."tmp_auth_code", $tmpAuthCode);
    }

    public static function getTmpAuthCode() {
        Cache::get(config("ding_talk.prefix")."tmp_auth_code");
    }

    public static function setPermanentAuthCodeInfo($code) {
        Cache::put(config("ding_talk.prefix")."permanent_auth_code_info", $code);
    }

    public static function getPermanentAuthCodeInfo() {
        return Cache::get(config("ding_talk.prefix")."permanent_auth_code_info");
    }

    public static function get($key) {
        return Cache::get(config("ding_talk.prefix").$key);
    }

    public static function set($key, $value) {
        Cache::put(config("ding_talk.prefix").$key, $value);
    }

}
