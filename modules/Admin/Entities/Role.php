<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\Contracts\EntrustRoleInterface;
use Modules\Admin\Traits\Entrust\RoleTrait;

class Role extends Model implements  EntrustRoleInterface {
    
    use RoleTrait;

    /**
     * Creates a new instance of the model.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = Config::get('entrust_admin.roles_table');
    }
    
}
