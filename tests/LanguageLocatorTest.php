<?php  namespace Palmabit\Multilanguage\Tests;

use Palmabit\Multilanguage\Classes\LanguageLocator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class LanguageLocatorTest extends TestCase {

  protected $anonymous_default_lang = 'it';
  protected $session_name = 'current_lang';

  public function setUp() {
    parent::setUp();
    $this->fake = \Faker\Factory::create();
    $this->locator = new LanguageLocator();
    Config::set('multilanguage.anonymous_default', $this->anonymous_default_lang);
    Config::set('multilanguage.session_name', $this->session_name);
  }

  /**
   * @test
   **/
  public function getAnonymousUserLanguage() {
    $this->assertEquals($this->anonymous_default_lang, $this->locator->get());
  }

  /**
   * @test
   **/
  public function getLoggedUserDefault() {
    $user_lang = 'en';
    $this->mockAuthReturnUserWithLang($user_lang);
    $this->assertEquals($user_lang, $this->locator->get());
  }

  /**
   * @test
   **/
  public function getLoggedUserPreferredCurrentLanguage() {
    $user_lang = 'en';
    $this->mockAuthReturnUserWithLang($user_lang);

    $expected_lang = 'de';
    Session::set($this->session_name, $expected_lang);

    $this->assertEquals($expected_lang, $this->locator->get());
  }

  /**
   * @param $preferred
   */
  protected function mockAuthReturnUserWithLang($preferred) {
    $logged_user = (object)["preferred_language" => $preferred];
    Auth::shouldReceive('user')->andReturn($logged_user);
  }

  /**
   * @test
   **/
  public function setLocaleAssociatedToTheLanguage() {
    $this->setLocalesOptions();

    $this->locator->set('en');
    // check for language location
    $this->assertEquals('en_US', setlocale(LC_TIME,0));
  }

  public function setDefaultLocale() {
  }

  protected function setLocalesOptions() {
    Config::set('multilanguage.languages', [
            "it" => "italiano",
            "en" => "inglese"
    ]);
    Config::set('multilanguage.locales', [
            "it" => "it_IT",
            "en" => "en_US"
    ]);
  }
}
 