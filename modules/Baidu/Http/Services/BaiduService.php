<?php

namespace Modules\Baidu\Http\Services;

use Modules\Baidu\Http\Requests\BaiduRequest;

class BaiduService {
    
    /**
     *
     * @var BaiduRequest 
     */
    protected $request;


    public function __construct(BaiduRequest $request) {
        $this->request  = $request;
    }
}

