<?php

namespace DingTalk\Api;

use DingTalk\Util\Http;
/**
 * 会话管理接口
 */
class Chat {

    public static function createChat($accessToken, $chatOpt) {
        $response = Http::post("/chat/create", array("access_token" => $accessToken), json_encode($chatOpt));
        return $response;
    }

    public static function bindChat($accessToken, $chatid, $agentid) {
        $response = Http::get("/chat/bind", array("access_token" => $accessToken, "chatid" => $chatid, "agentid" => $agentid));
        return $response;
    }

    public static function sendmsg($accessToken, $opt) {
        $response = Http::post("/chat/send", array("access_token" => $accessToken), json_encode($opt));
        return $response;
    }

    public static function callback($accessToken, $opt) {
        $response = Http::post("/call_back/register_call_back", array("access_token" => $accessToken), json_encode($opt));
        return $response;
    }

    public static function getList($accessToken) {
        $response = Http::get("/chat/get", array("access_token" => $accessToken));
        return $response;
    }

}
