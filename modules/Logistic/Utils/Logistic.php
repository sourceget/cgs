<?php

namespace Modules\Logistic\Utils;

interface Logistic {
    
    public function getParamter();
    
    public function getServerApi();
    
    public function getRequestUrl();
    
    public function search($no, $name=null);
    
    
    
}
