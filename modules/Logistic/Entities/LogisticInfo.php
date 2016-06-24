<?php

namespace Modules\Logistic\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Logistic\Repositories\LogisticItemRepository;
use Modules\Logistic\Entities\LogisticItem;

class LogisticInfo extends Model {

    protected $table = 'logistic_info';
    
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'logistic_id', 'no', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];


    public function items(){
        return $this->hasMany(LogisticItem::class, 'logistic_id');
    }
    
    public function updateLogistic($logisticId, $data) {

        $flag = false;

        if (!is_array($data)) {
            return false;
        }
        
        $table = app(LogisticItemRepository::class);
        foreach ($data as $key => $item) {
            if ($item['time'] <= $this->updated_at) {
                continue;
            }
            $this->updated_at = $item['time'];
            $table->create([
                'logistic_id'   => $logisticId,
                'location' => !isset($item['location']) ?: '已发货',
                'context' => strip_tags($item['context']),
                'created_at' => $item['time'],
            ]);
            $flag = true;
        }
        if ($flag) {
            $this->save();
        }
    }

}
