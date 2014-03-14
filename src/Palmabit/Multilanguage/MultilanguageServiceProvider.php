<?php namespace Palmabit\Multilanguage;

use App;
use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;
use Palmabit\Multilanguage\Classes\GestoreIlluminate;
use Palmabit\Multilanguage\Classes\UrlTranslatorIlluminate;

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
        require __DIR__."/../../routes.php";
        // include i filtri
        require __DIR__."/../../filters.php";

        $this->registerAliases();
    }

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
        App::bind('multilanguage', function()
        {
            return new GestoreIlluminate();
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

    protected function registerAliases()
    {
        AliasLoader::getInstance()->alias("L", 'Palmabit\Multilanguage\Facades\Multilanguage');
        AliasLoader::getInstance()->alias("URLT", 'Palmabit\Multilanguage\Facades\Urltranslator');
    }

}