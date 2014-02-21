<?php namespace Palmabit\Multilanguage;

use Illuminate\Support\ServiceProvider;

class MultilanguageServiceProvider extends ServiceProvider {

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
		$this->package('palmabit/multilanguage');

        // include le route
        require_once __DIR__."/../routes.php";
        // include i filtri
        require_once __DIR__."/../filters.php";
        // include il form helper
        require_once __DIR__."/../Helper/FormHelper.php";
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
        App::bind('multilingua', function()
        {
            return new GestoreIlluminate('app/Multilingua/Config');
        });
        App::bind('urltranslator', function()
        {
            return new UrlTranslatorIlluminate();
        });
    }

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}