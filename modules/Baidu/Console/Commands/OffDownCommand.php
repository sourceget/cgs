<?php

namespace Modules\Baidu\Console\Commands;

use Illuminate\Console\Command;
use Baidu\Sdk\BaiduPCS;

class OffDownCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'taobao:down';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
    

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $file   = storage_path().'/video.csv';
        
        $files  = file($file);
        
        if(!$files){
            $this->error('file empty.');
            return false;
        }
        $token  = env('baidu_token');
        $root_dir = '/apps' . '/131IM/mp4/';
        $pcs    = new BaiduPCS($token);
        $rateLimit  = 1024 * 8 * 20;
        $timeout    = 120;
        $callback   = '';
        foreach ($files as $key => $f) {
            $this->info('=======================================================');
            $data   = explode(',', $f);
            $ext    = pathinfo($data[3], PATHINFO_EXTENSION);
            if(!$ext){
                $ext    = pathinfo($data[4], PATHINFO_EXTENSION);
                $savePath   = $root_dir . $data[2].'.'.$ext;
                $sourceUrl  = $data[4];
            }else{
                $savePath   = $root_dir . $data[2].'.'.$ext;
                $sourceUrl  = $data[3];
            }
            
            $ret    = $pcs->addOfflineDownloadTask($savePath, $sourceUrl, $rateLimit, $timeout, $callback);
            if(isset($ret['task_id'])){
                unset($files[$key]);
                file_put_contents($file, implode("", $files));
                $this->info($data[0] .' success download.');
            }else{
                $error  = $ret['error_msg'];
                $this->error($data[0] .':' . $error);
                if($error == 'Invalid source url'){
                    unset($files[$key]);
                    $files[]    = $f;
                    file_put_contents($file, implode("", $files));
                    $this->error($sourceUrl);
                    $this->error('move to queue last.');
                    file_put_contents(storage_path().'/url.txt', $sourceUrl."\r\n",FILE_APPEND);
                }
                if($error == 'too many tasks'){
                    sleep(15);
                }
            }
            $tasks  = $pcs->listOfflineDownloadTask(0,30);
            $this->info('current queue has '.$tasks['total'] .' tasks.');
            if($tasks['total'] >= 5){
                sleep(15);
            }
        }
    }
    
}
