<?php

namespace Modules\Admin\Entities;

use Modules\Admin\Traits\Entrust\PermissionTrait;
use Zizaco\Entrust\Contracts\EntrustPermissionInterface;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model implements EntrustPermissionInterface {

    use PermissionTrait;

    /**
     * Creates a new instance of the model.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = []) {
        parent::__construct($attributes);
        $this->table = Config::get('entrust_admin.permissions_table');
    }

}
