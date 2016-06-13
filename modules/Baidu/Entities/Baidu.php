<?php

namespace Modules\Baidu\Entities;
   
use Illuminate\Database\Eloquent\Model;

class Baidu extends Model {
    
    protected $table    = 'baidu';
    
    public $timestamps   = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

}