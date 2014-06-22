<?php namespace Mahngiel\Redbook;

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
        require_once __DIR__ . '/Support/Macros.php';

        // include routes
        include __DIR__ . '/../../routes.php';

        // Change database if req'd
        if ( \Input::has( 'database' ))
        {
            \Session::set( 'activeDatabase', \Input::get( 'database' ) );
        }

        // Return the singleton when requested
        $this->app['colophon'] = $this->app->share( function ( $app ) { return \App::make( 'Colophon' ); } );

	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		//
        $this->app->register('\Mahngiel\Redbook\Support\Providers\ColophonServiceProvider');
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
        return array('redbook', 'colophon');
	}

}
