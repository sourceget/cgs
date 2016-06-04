<?php

namespace Modules\Department\Providers;

use Illuminate\Support\ServiceProvider;

class DepartmentServiceProvider extends ServiceProvider {

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
            __DIR__.'/../Config/config.php' => config_path('module_department.php'),
        ]);
        $this->mergeConfigFrom(
            __DIR__.'/../Config/config.php', 'department'
        );
    }

    /**
     * Register views.
     * 
     * @return void
     */
    public function registerViews()
    {
        $viewPath = base_path('resources/views/modules/department');

        $sourcePath = __DIR__.'/../Resources/views';

//        $this->publishes([
//            $sourcePath => $viewPath
//        ]);

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
                return $path . '/modules/department';
        }, \Config::get('view.paths')), [$sourcePath]), 'department');
    }

    /**
     * Register translations.
     * 
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = base_path('resources/lang/modules/department');

        if (is_dir($langPath)) {
                $this->loadTranslationsFrom($langPath, 'department');
        } else {
                $this->loadTranslationsFrom(__DIR__ .'/../Resources/lang', 'department');
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
