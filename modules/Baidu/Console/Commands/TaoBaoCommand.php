<?php

namespace Modules\Baidu\Console\Commands;

use Illuminate\Console\Command;
use App\Events\TaoBaoEvent;
use Httpful\Request;

class TaoBaoCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'taobao:event';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
    
    protected $url  = 'http://www.avtaobao.me/recent/';

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
        for($i=111;$i>0;$i--){
            $this->info('line '.$i);
            $this->doRun($i);
        }
    }
    
    protected function doRun($page){
        $url    = $this->url .$page.'/';
        if($page == 1){
            $url    = $this->url;
        }
        $reqest = Request::get($url);
        
        $resp   = $reqest->send();
        preg_match_all('~<li id="video-(\d+)">~', $resp, $id);
        preg_match_all('~<span class="video-title">(.*?)</span>~', $resp, $title);
        preg_match_all('~<span class="video-overlay badge transparent">(.*?)</span>~s', $resp, $mins);
        preg_match_all('~"http://www.avtaobao.me/media/(.*?)"~', $resp, $pics);
        //dd(count($id[1]).'-'.count($title[1]).'-'.count($mins[1]));
        $this->output->progressStart(count($title[1]));
        
        foreach ($id[1] as $key => $val) {
            $time   = str_replace(["\t","\n"], ['',''], $mins[1][$key]);
            $t      = $title[1][$key];
            $url    = 'http://www.avtaobao.me/'.$val.'/';
            $event  = new TaoBaoEvent($val,$t, $time, $url, trim($pics[0][$key]));
            event($event);
            $this->output->progressAdvance();
        }
        $this->output->progressFinish();
    }
}
