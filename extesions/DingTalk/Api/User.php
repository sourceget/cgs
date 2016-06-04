<?php

namespace DingTalk\Api;

use DingTalk\Util\Http;

class User {

    public static function getUserInfo($accessToken, $code) {
        $response = Http::get("/user/getuserinfo", array("access_token" => $accessToken, "code" => $code));
        return json_encode($response);
    }

    public static function simplelist($accessToken, $deptId, $offset = 0, $size = 100) {
        $response = Http::get("/user/simplelist", array("access_token" => $accessToken, "department_id" => $deptId, 'offset' => $offset, 'size' => $size));
        return $response->userlist;
    }

    public static function getList($accessToken, $deptId, $offset = 0, $size = 100) {
        $response = Http::get("/user/list", array("access_token" => $accessToken, "department_id" => $deptId, 'offset' => $offset, 'size' => $size));
        return $response->userlist;
    }

}
