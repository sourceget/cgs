<?php

namespace Modules\Admin\Entities;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Modules\Admin\Traits\Entrust\UserTrait;
use Modules\Department\Entities\Department;

class Admin extends Authenticatable {

    use UserTrait;

    protected $table = 'admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'mobile', 'is_enable',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    protected $profile  = [
        'position','ding_id','is_admin','is_leader','order'
    ];

        
    public function getProfile($key) {

        if (!in_array($key, $this->profile)) {
            return null;
        }
        return $this->hasOne(AdminProfile::class)->where(['skey' => $key])->getResults();
    }

    public function setProfile($key, $value) {

        if (!in_array($key, $this->profile)) {
            return null;
        }

        return AdminProfile::create(['admin_id' => $this->id, 'skey' => $key, 'svalue' => $value]);
    }
    
    public function getAuthSalt() {
        return $this->salt;
    }
    
    public function departments(){
        return $this->belongsToMany(Department::class, 'department_admin','admin_id', 'department_id');
    }

    /**
     * 检测是不是历史密码
     * @param type $password
     */
    public function isHistory($password) {
        return false;
    }

    /**
     * 密码验证
     * @return type
     */
    public function password() {
        return $this->hasMany(AdminPassword::class)->orderBy("id", 'desc');
    }

}
