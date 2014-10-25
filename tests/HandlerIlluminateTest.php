<?php namespace Palmabit\Multilanguage\Tests;

use Palmabit\Multilanguage\Classes\HandlerIlluminate;
use Palmabit\Multilanguage\Classes\LanguageLocator;
use Mockery as m;
use L, App, Config, Lang;

class HandlerIlluminateTest extends TestCase {

  protected $locator;
  protected $handler;

  public function setUp() {
    parent::setUp();
    $this->locator = new LanguageLocatorStub();
    $this->handler = new HandlerIlluminateAppStub($this->locator);
  }

  public function tearDown() {
    m::close();
  }

  /**
   * @test
   **/
  public function canGetValue() {
    $expected_value = "fr";
    $this->locator->get_value = $expected_value;

    $this->assertEquals($expected_value, $this->handler->get());
  }

  /**
   * @test
   */
  public function canOverrideGetValue() {
    $this->setConfigStub();
    $this->handler->setLocator(new LanguageLocator());
    $expected_value = "it";
    $this->handler->set($expected_value);

    $this->assertEquals($expected_value, $this->handler->get());
  }

  /**
   * @test
   **/
  public function canTranslateAndUpdateLocale() {
    $key = "fake";
    $filename = "filename";
    $expected_translation = 'fake translation';
    Lang::shouldReceive('get')->once()->with("{$filename}.{$key}")->andReturn($expected_translation);

    $this->assertEquals($expected_translation, $this->handler->t($key, $filename));
    $this->assertTrue($this->handler->has_updated_locale);
  }

  /**
   * @test
   **/
  public function canTranslateUnknownString() {
    $key = "fake";
    $filename = "filename";
    Lang::shouldReceive('get')->once()->with("{$filename}.{$key}")->andReturn("{$filename}.{$key}");

    $this->assertEquals($key, $this->handler->t($key, $filename));
  }

  /**
   * @test
   **/
  public function canReturnEmptyStringOnTranslateIfStrictModeIsEnabled() {
    $key = "fake";
    $filename = "filename";
    Lang::shouldReceive('get')->once()->with("{$filename}.{$key}")->andReturn("{$filename}.{$key}");

    $this->assertEquals('', $this->handler->enableStrictMode()->t($key, $filename));
  }

  /**
   * @test
   **/
  public function canGetAvailableLanguageAsList() {
    $languages = [
            "it" => "italiano",
            "de" => "tedesco"
    ];
    Config::set('multilanguage::base.languages', $languages);

    $this->assertEquals($languages, $this->handler->getList());
  }

  /**
   * @test
   **/
  public function canGetDefaultFallbackLanguage() {
    $default_fallback_language = "zz";
    Config::set('multilanguage::base.default_fallback_language', $default_fallback_language);

    $this->assertEquals($default_fallback_language, $this->handler->getDefault());
  }

  /**
   * @test
   * @expectedException Palmabit\Multilanguage\Classes\Exceptions\LanguageNotPresentException
   **/
  public function canHandleExceptionIfLangNotExist() {
    $this->setConfigStub();
    $this->handler->setLocator(new LanguageLocator());
    $expected_value = "pk";
    $this->handler->set($expected_value);
  }

  /**
   * @test
   **/
  public function canReturnNewLangWhenSetted() {
    $this->setConfigStub();
    $this->handler->setLocator(new LanguageLocator());
    $expected_value = "it";

    $this->assertEquals($this->handler->set($expected_value), $expected_value);
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

class LanguageLocatorStub {
  public $get_value;

  public function get() {
    return $this->get_value;
  }
}

class HandlerIlluminateAppStub extends HandlerIlluminate {
  public $has_updated_locale = false;

  public function forceUpdateLocale() {
    $this->has_updated_locale = true;
  }
}