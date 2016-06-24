<?php

namespace Modules\Logistic\Utils;

use Modules\Logistic\Utils\Logistic;
use Modules\Logistic\Repositories\LogisticRepository;
use Modules\Logistic\Repositories\LogisticInfoRepository;

/**
 * Description of CaiNiao
 *
 * @author Administrator
 */
class CaiNiao implements Logistic {

    protected $name;
    
    protected $no;
    
    protected $logisticId;

    /**
     *
     * @var LogisticRepository 
     */
    protected $table;

    function __construct() {
        $this->table = app(LogisticRepository::class);
    }

    public function getParamter() {
        return ['nu' => $this->no, 'com' => $this->name];
    }

    public function getServerApi() {
        return 'https://open.onebox.so.com/api/getkuaidi';
    }

    public function getRequestUrl() {
        $data = $this->getParamter();


        if (!$this->name) {
            unset($data['com']);
        } else {
            $obj = $this->table->getLogistic($this->name);
            $data['com'] = $obj->code;
            $this->logisticId   = $obj->id;
        }
        return $this->getServerApi() . '?' . http_build_query($data);
    }

    protected function proccess() {
        $url = $this->getRequestUrl();

        $ch = curl_init();
        // 2. 设置选项，包括URL
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 信任任何证书 
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2); // 检查证书中是否设置域名  
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0'); // 检查证书中是否设置域名  
        // 3. 执行并获取HTML文档内容
        $output = curl_exec($ch);
        $data = json_decode($output, true);
        
        if (!isset($data['errcode'])) {
            throw new \Exception('请求失败！');
        }
        
        if ($data['errcode']) {
            throw new \Exception($data['errmsg']);
        }

        //物流公司
        if(!$this->logisticId){
            $this->logisticId   = $this->table->findOneBy('code', $data['data']['com'])->id;
        }

        return array_reverse($data['data']['data']);
    }

    public function search($no, $name = null) {

        $this->name = $name;

        $this->no = trim($no);

        $ret = $this->proccess();
 
        if (is_array($ret)) {
            app(LogisticInfoRepository::class)->log($this->logisticId, $this->no, $ret);
        }
        return $ret;
    }

}
