<?php

namespace Modules\V1\Providers;

use Illuminate\Support\ServiceProvider;

class V1ServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;
    
    protected $namespace = 'Modules\\Modules\\Console\\';
    
    protected $commands = [];
    /**
     * Boot the application events.
     * 
     * @return void
     */
    public function boot() {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {		
        $this->registerCommand();
    }
    
    protected function registerCommand() {
        if ($this->commands) {
            foreach ($this->commands as $command) {
                $this->commands($this->namespace . $command . 'Command');
            }
        }
    }
    
    /**
     * Register config.
     * 
     * @return void
     */
    protected function registerConfig() {
        $this->publishes([
            __DIR__.'/../Config/config.php' => config_path('module_v1.php'),
        ]);
        $this->mergeConfigFrom(
            __DIR__.'/../Config/config.php', 'v1'
        );
    }

    /**
     * Register views.
     * 
     * @return void
     */
    public function registerViews() {
        $viewPath = base_path('resources/views/modules/v1');

        $sourcePath = __DIR__.'/../Resources/views';

//        $this->publishes([
//            $sourcePath => $viewPath
//        ]);

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
                return $path . '/modules/v1';
        }, \Config::get('view.paths')), [$sourcePath]), 'v1');
    }

    /**
     * Register translations.
     * 
     * @return void
     */
    public function registerTranslations() {
        $langPath = base_path('resources/lang/modules/v1');

        if (is_dir($langPath)) {
                $this->loadTranslationsFrom($langPath, 'v1');
        } else {
                $this->loadTranslationsFrom(__DIR__ .'/../Resources/lang', 'v1');
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides(){
        $provides = [];

        if ($this->commands) {
            foreach ($this->commands as $command) {
                $provides[] = $this->namespace . $command . 'Command';
            }
        }

        return $provides;
    }

}
