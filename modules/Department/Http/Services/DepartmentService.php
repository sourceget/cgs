<?php

namespace Modules\Department\Http\Services;

use Modules\Department\Http\Requests\DepartmentRequest;
use DingTalk\Api\Auth;
use DingTalk\Api\Department;
use Modules\Department\Repositories\DepartmentRepository;

class DepartmentService {
    
    /**
     *
     * @var DepartmentRequest 
     */
    protected $request;
    
    /**
     *
     * @var DepartmentRepository 
     */
    protected $table;


    protected $token;


    public function __construct(DepartmentRequest $request) {
        $this->request  = $request;
        $this->table    = app(DepartmentRepository::class);
    }
    
    public function sync(){
        
        $this->token    = Auth::getAccessToken();
        
        $list   = Department::listDept($this->token);
        
        if(!$list){
            return [];
        }
        foreach ($list as $key => $item) {
            $ret    = $this->table->findOneBy('name', $item->name);
            if($ret){
                continue;
            }
            $data   = ['code'=>$item->id,'name'=>$item->name];
            
            if(isset($item->parentid)){
                $parent = $this->table->findOneBy('code', $item->parentid);
                if($parent){
                    $data['parent_id']  = $parent->id;
                }
            }
            $this->table->create($data);
        }
    }
    
}

