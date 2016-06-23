<?php

namespace Modules\Workflow\Entities;
   
use Illuminate\Database\Eloquent\Model;

class WorkFlow extends Model {
    
    protected $table    = 'work_flow';
    
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