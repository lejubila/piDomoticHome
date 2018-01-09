<?php

namespace Lejubila\PiDomoticHome\module;

use Illuminate\Support\ServiceProvider;

abstract class AbstractModuleServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Module identify
     *
     * @var string
     */
    protected $idModule = '';

    /**
     * Name of Module class
     *
     * @var string
     */
    protected $moduleClassName = '';

    /**
     * Directory of module source
     *
     * @var string
     */
    protected $moduleBaseDir = '';

    /**
     * Where the route file lives, both inside the package and in the app (if overwritten).
     *
     * @var string
     */
    public $routeFilePath = [
        '/routes/public.php',
        '/routes/authenticated.php',
    ];

    /**
     * Set idModule into $this->idModule
     */
    abstract protected function setIdModule();

    /**
     * Set module class name in $5his->moduleClassName
     */
    abstract protected function setModuleClassName();

    /**
     * Set directory of Module in $this->moduleBaseDir = $this->moduleBaseDir
     */
    abstract protected function setModuleBaseDir();

    /**
     * AbstractModuleServiceProvider constructor.
     * @param \Illuminate\Contracts\Foundation\Application $app
     */
    public function __construct(\Illuminate\Contracts\Foundation\Application $app)
    {
        parent::__construct($app);
        $this->setIdModule();
        $this->setModuleClassName();
        $this->setModuleBaseDir();
    }

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(\Illuminate\Routing\Router $router)
    {
        $this->setupConfig();
        $this->setupView();
        $this->setupTranslation();

        //$this->registerAdminMiddleware($this->app->router);
        $this->setupRoutes();
        $this->publishFiles();
        $this->loadHelpers();
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        // Register the module
        $this->app->singleton( Module::class, function(){
            return new Module();
        });
    }


    /**
     *
     */
    protected function setupConfig()
    {
        // use the vendor configuration file as fallback
        $this->mergeConfigFrom(
            $this->moduleBaseDir.'/config/pidomotichome/modules/'.$this->idModule.'.php', 'pidomotichome.modules.'.$this->idModule
        );
    }

    /**
     *
     */
    protected function setupView()
    {
        // LOAD THE VIEWS
        // - first the published views (in case they have any changes)
        $viewNamespace = config('pidomotichome.modules.'.$this->idModule.'.viewNamespace');
        $this->loadViewsFrom(resource_path('views/vendor/lejubila/pidomotichome/modules/'.$this->idModule), $viewNamespace);
        // - then the stock views that come with the package, in case a published view might be missing
        $this->loadViewsFrom(realpath($this->moduleBaseDir.'/resources/views'), $viewNamespace);

    }

    /**
     *
     */
    protected function setupTranslation()
    {
        $this->loadTranslationsFrom(realpath($this->moduleBaseDir.'/resources/lang'), 'pidomotichome.modules.'.$this->idModule);
    }


    /**
     * Load the piDomoticHome helper methods, for convenience.
     */
    public function loadHelpers()
    {
        require_once $this->moduleBaseDir.'/helpers.php';
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function setupRoutes()
    {
        foreach($this->routeFilePath as $routeFilePath) {
            $routeFilePathInUse = $this->moduleBaseDir.$routeFilePath;
            $this->loadRoutesFrom($routeFilePathInUse);
        }
    }

    /**
     *
     */
    public function publishFiles()
    {
        // publish config file
        $this->publishes([$this->moduleBaseDir.'/config' => config_path()], 'config');

        // publish lang files
        $this->publishes([$this->moduleBaseDir.'/resources/lang' => resource_path('lang/vendor/pidomotichome/modules')], 'lang');

        // publish views
        $this->publishes([$this->moduleBaseDir.'/resources/views' => resource_path('views/vendor/pidomotichome/modules/'.$this->idModule)], 'views');

        // publish public Backpack assets
        $this->publishes([$this->moduleBaseDir.'/public' => public_path('vendor/pidomotichome/modules/'.$this->idModule)], 'public');

    }
}
