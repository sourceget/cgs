<?php

namespace SourceGet\Generate\Providers;

use Illuminate\Support\ServiceProvider;

class SourceGetGenerateServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;
    protected $namespace = 'SourceGet\\Generate\\Console\\Commands\\';
    protected $commands = [
        'Application',
        'Controller',
        'Module',
        'Repository',
        'Request',
        'Service',
        'Trait'
    ];

    /**
     * Boot the application events.
     * 
     * @return void
     */
    public function boot() {
        
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {
        foreach ($this->commands as $command) {
            $this->commands($this->namespace . $command . 'Command');
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides() {
        $provides = [];

        foreach ($this->commands as $command) {
            $provides[] = $this->namespace . $command . 'Command';
        }

        return $provides;
    }

}
