<?php

namespace Modules\V1\Http\Services;

use Modules\V1\Http\Requests\V1Request;

class V1Service {
    
    /**
     *
     * @var V1Request 
     */
    protected $request;


    public function __construct(V1Request $request) {
        $this->request  = $request;
    }
}

