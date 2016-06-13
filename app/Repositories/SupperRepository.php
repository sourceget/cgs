<?php

namespace App\Repositories;

use Bosnadev\Repositories\Eloquent\Repository;

class SupperRepository extends Repository {

    public function model() {
        
    }
    
    /**
     * 更新记录
     * @param array $data
     * @param string $id
     * @param string $attribute
     * @return Object
     */
    public function update(array $data, $id, $attribute = "id")
    {
        if($attribute == $id){
            return $this->updateRich($data, $id);
        }
        $model  = $this->findBy($attribute, $id);
        if(!$model){
            throw new \Exception($this->model() .'(' .$id. ') Not Fond');
        }
        return $model->fill($data)->save();
    }
    
    /**
     * 查找一条记录
     * @param type $attribute
     * @param type $value
     * @param type $columns
     * @return type
     */
    public function findOneBy($attribute, $value, $columns = ['*']){
        return $this->findBy($attribute, $value, $columns);
    }

}
