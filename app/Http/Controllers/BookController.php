<?php

namespace App\Http\Controllers;

use Chrisbjr\ApiGuard\Http\Controllers\ApiGuardController;
use ApiGuardAuth;

class BookController extends ApiGuardController {

    protected $apiMethods = [
        'getIndex' => [
            'keyAuthentication' => false,
            'level' => 11
        ],
    ];

    function index() {
        $user = ApiGuardAuth::getUser();
        return response()->json($user->toArray());
    }

}
