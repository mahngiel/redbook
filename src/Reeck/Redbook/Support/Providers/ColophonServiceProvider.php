<?php namespace Reeck\Redbook\Support\Providers;

use Reeck\Redbook\Colophon\Colophon;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
 
class ColophonServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = true;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('redbook/colophon');
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
            $loader->alias('Colophon', 'Reeck\Redbook\Support\Facades\Colophon');
        });

        $this->app->singleton('Colophon', function(){
            return new Colophon();
        });

        // Return the singleton when requested
        $this->app['colophon'] = $this->app->share( function ( $app ) { return \App::make('Colophon'); } );
    }

    public function provides()
    {
        return array('colophon');
    }
}
