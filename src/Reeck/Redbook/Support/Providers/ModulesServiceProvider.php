<?php namespace Reeck\Redbook\Support\Providers;

use Reeck\Redbook\Modules\Modules;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class ModulesServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('redbook/modules');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
        // Auto alias
        $this->app->booting(function(){
                $loader = AliasLoader::getInstance();
                $loader->alias('Modules', 'Reeck\Redbook\Support\Facades\Modules');
            });

        // Bind the resource as a singleton so we don't abuse the database
        $this->app->singleton('Modules', function(){
                return new Modules();
            });

        // Return the singleton when requested
        $this->app['modules'] = $this->app->share( function ( $app ) { return \App::make('Modules'); } );
    }

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('modules');
	}

}
