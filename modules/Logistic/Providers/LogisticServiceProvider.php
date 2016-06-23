<?php

namespace Modules\Logistic\Providers;

use Illuminate\Support\ServiceProvider;

class LogisticServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;
    protected $namespace = 'Modules\\Logistic\\Console\\';
    protected $commands = [
        'ImportCompany'
    ];

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
            __DIR__ . '/../Config/config.php' => config_path('module_logistic.php'),
        ]);
        $this->mergeConfigFrom(
                __DIR__ . '/../Config/config.php', 'logistic'
        );
    }

    /**
     * Register views.
     * 
     * @return void
     */
    public function registerViews() {
        $viewPath = base_path('resources/views/modules/logistic');

        $sourcePath = __DIR__ . '/../Resources/views';

//        $this->publishes([
//            $sourcePath => $viewPath
//        ]);

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
                            return $path . '/modules/logistic';
                        }, \Config::get('view.paths')), [$sourcePath]), 'logistic');
    }

    /**
     * Register translations.
     * 
     * @return void
     */
    public function registerTranslations() {
        $langPath = base_path('resources/lang/modules/logistic');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'logistic');
        } else {
            $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'logistic');
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides() {
        $provides = [];

        if ($this->commands) {
            foreach ($this->commands as $command) {
                $provides[] = $this->namespace . $command . 'Command';
            }
        }

        return $provides;
    }

}
