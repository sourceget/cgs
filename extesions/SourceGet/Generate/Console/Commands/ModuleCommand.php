<?php

namespace SourceGet\Generate\Console\Commands;

use Illuminate\Console\Command;
use Module;

class ModuleCommand extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ue:module 
            {name : The Module Name }
      ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a new Application Module.';
    
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

        if (!Module::has($this->name)) {
            $this->call('module:make', [
                'name' => [$this->name],
                '--force'=> true
            ]);
            $this->call('module:make-application', [
                'name' => $this->name,
                'module'=> $this->name
            ]);
        }

        $this->path = str_replace('\\', '/', Module::getModulePath($this->name));
        
        if(strtolower($this->name) == snake_case($this->name)){
            return true;
        }
        
        $files  = [
            'Http/Controllers/'.$this->name.'Controller.php',
            'Providers/'.$this->name.'ServiceProvider.php',
            'Resources/views/index.blade.php',
            'Http/routes.php',
        ];
        $new     = snake_case($this->name);
        $lower  = strtolower($this->name);

        foreach ($files as $key => $file) {
            $file   = $this->path . $file;
            $data   = file_get_contents($file);
            $data   = str_replace($lower, $new, $data);
            $data   = str_replace(ucfirst($lower), $this->name, $data);
            file_put_contents($file, $data);
        }
    }

}
