<?php

namespace Modules\Logistic\Console;

use Illuminate\Console\Command;
//use Symfony\Component\Console\Input\InputOption;
//use Symfony\Component\Console\Input\InputArgument;
use Module;
use Modules\Logistic\Repositories\LogisticRepository;

class ImportCompanyCommand extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'ue:logistic-import-company';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Logistic module import company data.';
    
    /**
     *
     * @var LogisticRepository 
     */
    protected $table;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire() {
        $this->table    = app(LogisticRepository::class);
        $file   = Module::getPath().'/Logistic/data/company.txt';
        if(!file_exists($file)){
            $this->error('file not found.');
            return false;
        }
        
        $data   = file_get_contents($file);
        preg_match_all('~<option value="(.*?)">(.*?)</option>~', $data, $matches);
        if(!isset($matches[1]) || !isset($matches[2])){
            $this->error('data not found.');
            return false;
        }
        $data = array_combine($matches[1], $matches[2]);
        
        $this->output->progressStart(count($data));
        
        foreach ($data as $key => $value) {
            $ret    = $this->table->findOneBy('code', $key);
            $this->output->progressAdvance();
            if($ret){
                continue; 
            }
            $this->table->create(['code'=>$key,'name'=>$value]);
        }
        $this->output->progressFinish();
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments() {
        return [
            //['example', InputArgument::REQUIRED, 'An example argument.'],
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions() {
        return [
            //['example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null],
        ];
    }

}
