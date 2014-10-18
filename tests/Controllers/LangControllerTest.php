<?php  namespace Palmabit\Multilanguage\Tests\Controllers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use L, App;
use Palmabit\Multilanguage\Tests\TestCase;

class LangControllerTest extends TestCase {
  /**
   * @test
   **/
  public function swapCurrentLanguage() {
    $new_lang = 'us';
    L::shouldReceive('set')->once()->with($new_lang);

    $this->action('POST', 'Palmabit\Multilanguage\Controllers\LangController@change', ['new_lang' => $new_lang]);
  }

  /**
   * @test
   **/
  public function canGetWrongDataError() {
    $response = $this->action('POST', 'Palmabit\Multilanguage\Controllers\LangController@changeRest', []);

    $this->assertEquals($response->getStatusCode(), 400);
  }

  /**
   * @test
   **/
  public function canGetWrongDataError2() {
    $new_lang = 'us';

    $response = $this->action('POST', 'Palmabit\Multilanguage\Controllers\LangController@changeRest', ['wrong_name' => $new_lang]);

    $this->assertEquals($response->getStatusCode(), 400);
  }

  /**
   * @test
   **/
  public function canHandleErrorIfLangNotExists() {
    $new_lang = 'us';
    $this->setConfigStub();

    $response = $this->action('POST', 'Palmabit\Multilanguage\Controllers\LangController@changeRest', ['lang' => $new_lang]);

    $this->assertEquals($response->getStatusCode(), 400);
  }

  /**
   * @test
   **/
  public function canSetLanguage() {
    Session::start();
    L::set('en');
    $new_lang = 'it';
    $this->setConfigStub();

    $response = $this->action('POST', 'Palmabit\Multilanguage\Controllers\LangController@changeRest', ['lang' => $new_lang]);
    $content = json_decode($response->getContent(), true);

    $this->assertEquals($content, ['lang' => $new_lang, 'success' => true]);
    $this->assertEquals($content['lang'], L::get());
  }

  /**
   * @test
   **/
  public function canSetLanguagePassedAsArgument() {
    Session::start();
    L::set('en');
    $new_lang = 'it';
    $this->setConfigStub();

    $controller = App::make('Palmabit\Multilanguage\Controllers\LangController');
    $content = $controller->changeRest($new_lang);

    $this->assertEquals($content['lang'], L::get());
  }

  /**
   * @test
   **/
  public function canGetWrongDataErrorIfLangStringIsVoid() {
    $controller = App::make('Palmabit\Multilanguage\Controllers\LangController');
    $response = $controller->changeRest();

    $this->assertEquals($response->getStatusCode(), 400);
  }

  protected function setConfigStub() {
    Config::set('multilanguage::base.languages', [
            "it" => "italian",
            "en" => "english",
            "de" => "german",
            "fr" => "french"
    ]);
  }
}