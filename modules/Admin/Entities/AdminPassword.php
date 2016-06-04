<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;

class AdminPassword extends Model {

    protected $table = 'admin_password';
    
    protected $fillable = ['admin_id','content'];

    public function admin() {
        return $this->belongsTo(Admin::class);
    }

}
