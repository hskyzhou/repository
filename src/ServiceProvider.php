<?php
namespace HskyZhou\Repository;

/**
 * Class RepositoryServiceProvider
 * @package HskyZhou\Repository
 */
class ServiceProvider extends \Illuminate\Support\ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;


    /**
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([__DIR__ . '/../config/repository.php' => config_path('repository.php')], 'config');

        $this->mergeConfigFrom(__DIR__ . '/../config/repository.php', 'repository');
    }


    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->commands('HskyZhou\Repository\Consoles\Commands\RepositoryCommand');
        $this->commands('HskyZhou\Repository\Consoles\Commands\EntityCommand');
        $this->commands('HskyZhou\Repository\Consoles\Commands\BindingsCommand');
        $this->commands('HskyZhou\Repository\Consoles\Commands\ProcessCommand');
        $this->commands('HskyZhou\Repository\Consoles\Commands\ServiceCommand');
        $this->commands('HskyZhou\Repository\Consoles\Commands\PresenterCommand');
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
