<?php

namespace Modules\Workflow\Http\Services;

use Modules\Workflow\Http\Requests\WorkFlowRequest;

class WorkFlowService {
    
    /**
     *
     * @var WorkFlowRequest 
     */
    protected $request;


    public function __construct(WorkFlowRequest $request) {
        $this->request  = $request;
    }
}

