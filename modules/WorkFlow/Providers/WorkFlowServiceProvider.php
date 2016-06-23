<?php

namespace Modules\WorkFlow\Providers;

use Illuminate\Support\ServiceProvider;

class WorkFlowServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Boot the application events.
     * 
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {		
            //
    }

    /**
     * Register config.
     * 
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__.'/../Config/config.php' => config_path('module_work_flow.php'),
        ]);
        $this->mergeConfigFrom(
            __DIR__.'/../Config/config.php', 'work_flow'
        );
    }

    /**
     * Register views.
     * 
     * @return void
     */
    public function registerViews()
    {
        $viewPath = base_path('resources/views/modules/work_flow');

        $sourcePath = __DIR__.'/../Resources/views';

//        $this->publishes([
//            $sourcePath => $viewPath
//        ]);

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
                return $path . '/modules/work_flow';
        }, \Config::get('view.paths')), [$sourcePath]), 'work_flow');
    }

    /**
     * Register translations.
     * 
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = base_path('resources/lang/modules/work_flow');

        if (is_dir($langPath)) {
                $this->loadTranslationsFrom($langPath, 'work_flow');
        } else {
                $this->loadTranslationsFrom(__DIR__ .'/../Resources/lang', 'work_flow');
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
            return [];
    }

}
