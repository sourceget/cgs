<?php

namespace App\Supports\Hashing;

use Illuminate\Contracts\Hashing\Hasher as HasherContract;

class Md5Hasher implements HasherContract {

    public function check($value, $hashedValue, array $options = array()) {
        return $this->password($value, $hashedValue, $options);
    }

    public function make($value, array $options = array()) {
        return $this->password($value, null, $options);
    }

    public function needsRehash($hashedValue, array $options = array()) {
        
    }

    protected function password($plain, $hashedValue = null, $options) {
        $str = md5($plain);
        return strtolower(md5(substr($str, 16, 8) . $str . substr($str, 8, 8)));
    }

}
