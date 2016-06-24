<?php

namespace Modules\Logistic\Http\Services;

use Modules\Logistic\Http\Requests\LogisticRequest;

class LogisticService {
    
    /**
     *
     * @var LogisticRequest 
     */
    protected $request;


    public function __construct(LogisticRequest $request) {
        $this->request  = $request;
    }
}

