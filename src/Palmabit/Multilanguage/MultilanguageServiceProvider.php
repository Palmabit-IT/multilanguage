<?php namespace Palmabit\Multilanguage;

use App, L;
use Palmabit\Multilanguage\Classes\Commands\FetchTranslateStrings;
use Palmabit\Multilanguage\Classes\UrlWrapper;
use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;
use Palmabit\Multilanguage\Classes\HandlerIlluminate;
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
  public function boot() {
    $this->package('palmabit/multilanguage');

    require __DIR__ . "/../../routes.php";
    require __DIR__ . "/../../filters.php";
    require __DIR__ . "/../../composer.php";

    $this->registerAliases();
    $this->updateLocales();
  }

  /**
   * Register the service provider.
   *
   * @return void
   */
  public function register() {
    App::bind('multilanguage', function () {
      return new HandlerIlluminate();
    });

    App::bind('urltranslator', function () {
      return new UrlWrapper();
    });

    $this->registerCommands();
  }

  /**
   * Get the services provided by the provider.
   *
   * @return array
   */
  public function provides() {
    return array ();
  }

  protected function registerAliases() {
    AliasLoader::getInstance()->alias("L", 'Palmabit\Multilanguage\Facades\Multilanguage');
    AliasLoader::getInstance()->alias("URL", 'Palmabit\Multilanguage\Facades\URL');
  }

  protected function updateLocales() {
    if (App::environment() != 'testing') {
      L::updateLocale();
    }
  }

  protected function registerCommands() {
    $this->app['multilanguage.fetch_translate_strings'] = $this->app->share(function ($app) {
      return new FetchTranslateStrings();
    });
    $this->commands('multilanguage.fetch_translate_strings');
  }
}