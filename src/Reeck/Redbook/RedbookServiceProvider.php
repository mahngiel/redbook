<?php namespace Reeck\Redbook;

use Illuminate\Support\ServiceProvider;

class RedbookServiceProvider extends ServiceProvider {

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
		$this->package('reeck/redbook');

        // load helper functions
        require_once __DIR__ . '/Support/Helpers.php';

        // include routes
        include __DIR__ . '/../../routes.php';

        // Return the singleton when requested
        $this->app['colophon'] = $this->app->share( function ( $app ) { return \App::make( 'Colophon' ); } );
        $this->app['modules'] = $this->app->share( function ( $app ) { return \App::make( 'Modules' ); } );
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		//
        $this->app->register('\Reeck\Redbook\Support\Providers\ColophonServiceProvider');
        $this->app->register('\Reeck\Redbook\Support\Providers\ModulesServiceProvider');
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
        return array('redbook', 'colophon', 'modules');
	}

}
