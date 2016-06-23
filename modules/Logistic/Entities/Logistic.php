<?php

namespace Modules\Logistic\Entities;
   
use Illuminate\Database\Eloquent\Model;

class Logistic extends Model {
    
    protected $table    = 'logistic';
    
    public $timestamps   = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code','name'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

}