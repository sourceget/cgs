<?php

namespace Modules\Baidu\Providers;

use Illuminate\Support\ServiceProvider;

class BaiduServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;
    protected $namespace = 'Modules\\Baidu\\Console\\Commands\\';
    protected $commands = [
        'Taobao',
        'OffDown',
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
        foreach ($this->commands as $command) {
            $this->commands($this->namespace . $command . 'Command');
        }
    }

    /**
     * Register config.
     * 
     * @return void
     */
    protected function registerConfig() {
        $this->publishes([
            __DIR__ . '/../Config/config.php' => config_path('module_baidu.php'),
        ]);
        $this->mergeConfigFrom(
                __DIR__ . '/../Config/config.php', 'baidu'
        );
    }

    /**
     * Register views.
     * 
     * @return void
     */
    public function registerViews() {
        $viewPath = base_path('resources/views/modules/baidu');

        $sourcePath = __DIR__ . '/../Resources/views';

//        $this->publishes([
//            $sourcePath => $viewPath
//        ]);

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
                            return $path . '/modules/baidu';
                        }, \Config::get('view.paths')), [$sourcePath]), 'baidu');
    }

    /**
     * Register translations.
     * 
     * @return void
     */
    public function registerTranslations() {
        $langPath = base_path('resources/lang/modules/baidu');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'baidu');
        } else {
            $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'baidu');
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
