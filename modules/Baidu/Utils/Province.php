<?php

namespace Modules\Baidu\Utils;

class Province {
    
    protected $url  = 'http://www.stats.gov.cn/tjsj/tjbz/xzqhdm/201504/t20150415_712722.html';
    
    
    public function proccess(){
        $data   = file_get_contents($this->url);
        preg_match_all('~<p class="MsoNormal"(.*?)</p>~s', $data, $matches);
        print_r(strip_tags($matches[0][0]));
        exit;
    }
}

