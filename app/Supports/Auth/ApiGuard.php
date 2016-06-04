<?php

namespace App\Supports\Auth;

use Chrisbjr\ApiGuard\Providers\Auth\Illuminate;
use Auth;
use Illuminate\Contracts\Auth\Guard as GuardContract;

class ApiGuard extends Illuminate {

    /**
     *
     * @var \Illuminate\Auth\SessionGuard
     */
    protected $guard;
    
    public function __construct(GuardContract $auth) {
        $name   = config('apiguard.guard');
        $this->auth = Auth::guard($name);
    }


    public function byId($id) {
        return $this->auth->onceUsingId($id);
    }

}
