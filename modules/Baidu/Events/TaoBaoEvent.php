<?php

namespace App\Events;

use Modules\Baidu\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Httpful\Request;
use Log;

class TaoBaoEvent extends Event {

    use SerializesModels;

    public $id;
    public $title;
    public $time;
    public $url;
    public $poster;
    public $video;
    public $tags;
    public $times;
    public $init    = 0;
    public $pic;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($id, $title, $time, $url, $pic) {
        $this->id       = $id;
        $this->time     = trim(str_replace('HD', '', $time));
        $this->title    = $title;
        $this->url      = $url;
        $this->pic      = str_replace('"', '', $pic);
    }
    
    public function run(){
        $ch = curl_init();
        //设置选项，包括URL
        curl_setopt($ch, CURLOPT_URL, 'http://www.avtaobao.me/embed/'.$this->id.'/');
        curl_setopt($ch, CURLOPT_COOKIE, 'ASPro_09787b84d9c9c0ba9068840a32d37f54=sg6dherigcrik1gtjbc7k39f92; a7978_pages=18; a7978_times=1; __atuvc=8%7C24; __atuvs=575d06fc02fab982007');
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);

        //执行并获取HTML文档内容
        $resp = curl_exec($ch);
        //释放curl句柄
        curl_close($ch);
        
        //播放地址
        preg_match_all('~source src="(.*?)"~', $resp, $matches);
        if(isset($matches[1][0])){
            $this->video    = $matches[1][0];
        }

    }
    
    public function writeFile() {
        $file = storage_path() . '/video.csv';
        $this->run();
        //$data   = [$this->id,  mb_convert_encoding($this->title, 'GBK', 'UTF-8'),$this->video];
        $data   = [$this->id, $this->time, $this->title,$this->video, $this->pic];
        file_put_contents($file, implode(',', $data)."\r\n", FILE_APPEND);
        
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn() {
        return [];
    }

}
