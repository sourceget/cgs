<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Modules\V1\Entities;

use Auth;

class PasswordGrantVerifier {

    protected $guard = 'admin';

    public function verify($username, $password) {
        $credentials = [
            'email' => $username,
            'password' => $password,
        ];


        if (Auth::guard($this->guard)->once($credentials)) {
            return Auth::guard($this->guard)->user()->id;
        }

        return false;
    }

}
