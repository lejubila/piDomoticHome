<?php

namespace Lejubila\PiDomoticHome;

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Route;

class PiDomoticHomeServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Where the route file lives, both inside the package and in the app (if overwritten).
     *
     * @var string
     */
    public $routeFilePath = [
        '/routes/pidomotichome/base.php',
        '/routes/pidomotichome/permissionmanager.php',
    ];

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(\Illuminate\Routing\Router $router)
    {
        // use the vendor configuration file as fallback
        $this->mergeConfigFrom(
            __DIR__.'/config/pidomotichome.php', 'pidomotichome'
        );

        // LOAD THE VIEWS
        // - first the published views (in case they have any changes)
        $this->loadViewsFrom(resource_path('views/vendor/lejubila/pidomotichome'), 'pidomotichome');
        // - then the stock views that come with the package, in case a published view might be missing
        $this->loadViewsFrom(realpath(__DIR__.'/resources/views'), 'pidomotichome');

        $this->loadTranslationsFrom(realpath(__DIR__.'/resources/lang'), 'pidomotichome');

        //$this->registerAdminMiddleware($this->app->router);
        $this->setupRoutes($this->app->router);
        $this->setupViewComposer();
        $this->publishFiles();
        $this->loadHelpers();
    }

    /**
     * Load the piDomoticHome helper methods, for convenience.
     */
    public function loadHelpers()
    {
        require_once __DIR__.'/helpers.php';
    }

    /**
     * Define the routes for the application.
     *
     * @param \Illuminate\Routing\Router $router
     *
     * @return void
     */
    public function setupRoutes(Router $router)
    {
        foreach($this->routeFilePath as $routeFilePath) {
            $routeFilePathInUse = __DIR__.$routeFilePath;
            $this->loadRoutesFrom($routeFilePathInUse);
        }
    }

    /**
     * Define composer view callback
     */
    protected function setupViewComposer() {

        require_once __DIR__.'/viewComposer.php';

    }


    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {

        // register the piDomoticHome module container
        $this->app->singleton( ModuleContainer::class, function(){
            return new ModuleContainer();
        });

        // register the current package
/*        $this->app->bind('base', function ($app) {
            return new Base($app);
        });*/

        // register its dependencies
/*        $this->app->register(\Jenssegers\Date\DateServiceProvider::class);
        $this->app->register(\Prologue\Alerts\AlertsServiceProvider::class);
        $this->app->register(\Creativeorange\Gravatar\GravatarServiceProvider::class);*/

        // register their aliases
/*        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('Alert', \Prologue\Alerts\Facades\Alert::class);
        $loader->alias('Date', \Jenssegers\Date\Date::class);
        $loader->alias('Gravatar', \Creativeorange\Gravatar\Facades\Gravatar::class);*/

        // register the services that are only used for development
/*        if ($this->app->environment() == 'local') {
            if (class_exists('Laracasts\Generators\GeneratorsServiceProvider')) {
                $this->app->register('Laracasts\Generators\GeneratorsServiceProvider');
            }
            if (class_exists('Backpack\Generators\GeneratorsServiceProvider')) {
                $this->app->register('Backpack\Generators\GeneratorsServiceProvider');
            }
        }*/

    }


    /*public function registerAdminMiddleware(Router $router)
    {
        Route::aliasMiddleware('admin', \Backpack\Base\app\Http\Middleware\Admin::class);
    }*/


    public function publishFiles()
    {
        // publish config file
        $this->publishes([__DIR__.'/config' => config_path()], 'config');

        // publish lang files
        //$this->publishes([__DIR__.'/resources/lang' => resource_path('lang/vendor/backpack')], 'lang');

        // publish views
        //$this->publishes([__DIR__.'/resources/views' => resource_path('views/vendor/backpack/base')], 'views');

        // publish public Backpack assets
        $this->publishes([__DIR__.'/public' => public_path('vendor/pidomotichome')], 'public');

    }
}
