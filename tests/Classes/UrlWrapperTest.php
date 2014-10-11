<?php  namespace Palmabit\Multilanguage\Tests\Classes;

use Palmabit\Multilanguage\Classes\UrlWrapper;
use Palmabit\Multilanguage\Tests\TestCase;
use URL, L, App, Route, Config;
use Mockery as m;

class UrlWrapperTest extends TestCase {

  protected $url;
  protected $laravel_url;

  public function setUp() {
    parent::setUp();
    $this->url = new UrlWrapper();
    $this->laravel_url = App::make('url');
    L::set('it');
  }

  public function tearDown() {
    m::close();
  }

  /**
   * @test
   **/
  public function prependLanguagePrefixWithUrlTo() {
    $expected_url = $this->laravel_url->to('/it/uri');

    $this->assertEquals($expected_url, $this->url->to('/uri'));
    $this->assertEquals($expected_url, $this->url->to('uri'));

    L::set('en');

    $this->assertEquals($this->laravel_url->to('/uri'), $this->url->to('uri', false));
  }

  /**
   * @test
   **/
  public function canPrepentGivenLanguagePrefix()
  {
    Config::set('multilanguage.languages',[
            "it" => "italiano",
            "en" => "inglese",
            "de" => "tedesco",
            "fr" => "francese"
    ]);

    $this->assertEquals($this->laravel_url->to('/language/italia/uri'), $this->url->to('/en/italia/uri',true,'language'));
    $this->assertEquals($this->laravel_url->to('/language'), $this->url->to('/en',true,'language'));
    $this->assertEquals($this->laravel_url->to('/language'), $this->url->to('en',true,'language'));
    // check for url starting with language
    $this->assertEquals($this->laravel_url->to('/language/entrophy'), $this->url->to('/entrophy',true,'language'));
  }

  /**
   * @test
   **/
  public function callUrlMethods() {
    $param = "_";
    $mock_url = m::mock('Illuminate\Routing\UrlGenerator');
    $mock_url->shouldReceive('method')
             ->once()
             ->with($param);

    $translator = new UrlWrapper($mock_url);

    $translator->method($param);
  }
}
 