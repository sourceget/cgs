<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Modules\V1\Entities;

use Auth;
use Cache;

class PasswordGrantVerifier {

    protected $guard = 'admin';

    public function verify($username, $password) {
        $key    = 'admin_'.md5($username.$password);
        $exist  = Cache::get($key);
        if($exist && $exist = 'y'){
            return true;
        }
        $credentials = [
            'email' => $username,
            'password' => $password,
        ];


        if (Auth::guard($this->guard)->once($credentials)) {
            Cache::put($key, 'y');
            return Auth::guard($this->guard)->user()->id;
        }
        Cache::put($key, 'n', 5);
        return false;
    }

}
