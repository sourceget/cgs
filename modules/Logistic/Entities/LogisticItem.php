<?php

namespace Modules\Logistic\Entities;

use Illuminate\Database\Eloquent\Model;

class LogisticItem extends Model {

    protected $table = 'logistic_item';
    public $timestamps = false;
    public static $hashTable = null;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'logistic_id', 'context', 'location', 'created_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    public function getTable() {
        if (static::$hashTable) {
            return $this->table . '_' . static::$hashTable;
        }
        return parent::getTable();
    }

    public function updateLogistic($data) {

        $flag = false;

        if (!is_array($data)) {
            return false;
        }

        foreach ($data as $key => $item) {
            if ($item['time'] >= $this->updated_at) {
                continue;
            }
            $this->updated_at = $item['time'];
            $flag = true;
        }
        if ($flag) {
            $this->save();
        }
    }

}
