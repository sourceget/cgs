<?php

namespace Modules\Api\Console\Commands;

use Mpociot\ApiDoc\Commands\GenerateDocumentation;

class GenerateApiCommand extends GenerateDocumentation {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api:generate 
                            {--output=public/docs : The output path for the generated documentation}
                            {--routePrefix= : The route prefix to use for generation}
                            {--routes=* : The route names to use for generation}
                            {--actAsUserId= : The user ID to use for API response calls}
                            {--router=laravel : The router to be used (Laravel or Dingo)}
                            {--bindings= : Route Model Bindings}
    ';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
        parent::handle();
    }

}
