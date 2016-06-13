<?php

namespace SourceGet\Generate\Console\Commands;

use Illuminate\Console\Command;
use Module;

class ApplicationCommand extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:make-application 
            {name : The app Name }
            {module : The Module Name }
      ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a new Application for the specified module.';
    
    protected $path = null;
    
    protected $name = null;

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
    public function handle() {
        
        $this->name = studly_case($this->argument('name'));
        $this->module = studly_case($this->argument('module'));

        if (!Module::has($this->name)) {
            $this->error('Module '.$this->name.' Not Exist!');
            return false;
        }

        $this->call('module:make-controller', [
            'controller' => $this->name,
            'module' => $this->module,
        ]);

        $this->call('module:make-model', [
            'model' => $this->name,
            'module' => $this->module,
        ]);
 
        $this->call('module:make-repository', [
            'name' => $this->name,
            'module' => $this->module,
        ]);

        $this->call('module:make-request', [
            'name' => $this->name,
            'module' => $this->module,
        ]);

        $this->call('module:make-trait', [
            'name' => $this->name,
            'module' => $this->module,
        ]);

        $this->call('module:make-seed', [
            'name' => $this->name,
            'module' => $this->module,
        ]);

        $this->call('module:make-provider', [
            'name' => $this->name,
            'module' => $this->module,
        ]);

        $this->call('module:make-service', [
            'name' => $this->name,
            'module' => $this->module,
        ]);

        $this->call('module:make-migration', [
            'name'=> 'create_'. snake_case($this->name).'_table',
            '--fields' => 'name:string',
            'module' => $this->module
        ]);
        
        $this->info('success');
    }

}
