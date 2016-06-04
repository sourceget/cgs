<?php

namespace Modules\Admin\Traits\Model;

use Modules\Admin\Entities\AdminProfile;

trait AdminTrait {

    public static function bootAdminTrait() {

    }

    function __get($key) {
        if (!property_exists($this, 'profile')) {
            return $this->getAttribute($key);
        }
        return $this->getProfile($key);
    }



}
