<?php

namespace Modules\Department\Entities;
   
use Illuminate\Database\Eloquent\Model;
use DingTalk\Api\Auth;
use DingTalk\Api\User;
use Modules\Admin\Repositories\AdminRepository;
use Modules\Admin\Entities\AdminPassword;
use Hash;
use Modules\Admin\Entities\Admin;
use Schema;

class Department extends Model {
    
    protected $table    = 'department';
    
    public $timestamps   = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'parent_id','code','name'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
    

    public function admins(){
        return $this->belongsToMany(Admin::class, 'department_admin', 'department_id', 'admin_id');
    }
    
    public function getUserList(){
        $token  = Auth::getAccessToken();
        $items  = User::getList($token, $this->code);
        return $items;
    }
    
    /**
     * 同步用户到数据库
     */
    public function syncUser(){
        
        $table  = app(AdminRepository::class);
        
        $items  = $this->getUserList();
        
        if(!$items){
            return [];
        }
        $conn   = Schema::getConnection();
        $success=[];
        foreach ($items as $key => $item) {
            $conn->beginTransaction();
            $user   = $table->findOneBy('name',$item->name);
            if($user){
                continue;
            }
            
            try {
                $user   = $table->create([
                    'name'  => $item->name,
                    'email' => $item->email,
                    'mobile'    => $item->mobile,
                    'is_enable' => $item->active
                ]);

                //职位
                $user->setProfile('position',$item->position);
                $user->setProfile('ding_id',$item->dingId);
                $user->setProfile('is_admin',$item->isAdmin);
                $user->setProfile('is_leader',$item->isLeader);
                $user->setProfile('order',$item->order);
                
                $user->departments()->attach($this->id);
                $pass   = AdminPassword::create(['admin_id'=>$user->id,'content'=> Hash::make(123456)]);
                $success[]  = $user;
                if($item->isLeader){
                    $this->leader_id    = $user->id;
                    $this->save();
                }
                $conn->commit();
            } catch (\Exception $exc) {
                $conn->rollBack();
                throw new \Exception($exc->getMessage());
            }
        }
        
        return $success;
    }

}