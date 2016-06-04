<?php

namespace Modules\Api\Http\Controllers;

use Chrisbjr\ApiGuard\Http\Controllers\ApiGuardController;
use ApiGuardAuth;
use Modules\Admin\Repositories\AdminRepository;

class ApiController extends ApiGuardController {

    protected $apiMethods = [
        'index' => [
            'keyAuthentication' => true,
            'level' => 10
        ],
    ];

    function index() {
        $user = ApiGuardAuth::getUser();
        $items = app(AdminRepository::class)->all();
        return response()->json(['code' => 200, 'items' => $items->toArray()]);
    }

}
