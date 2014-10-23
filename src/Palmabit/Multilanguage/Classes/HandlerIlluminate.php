<?php namespace Palmabit\Multilanguage\Classes;

use Palmabit\Multilanguage\Interfaces\GestoreInterface;
use Lang, App, Config, Session;

class HandlerIlluminate implements GestoreInterface {

  protected $locator;
  /**
   * Variable name to save in session
   *
   * @var String
   */
  protected $session_name;
  /**
   * If enabled return empty string on not found translations
   *
   * @var bool
   */
  protected $strict_mode = false;

  public function __construct($locator = null) {
    $this->locator = $locator ?: new LanguageLocator();
    //@todo remove this and use the given language in input to save a product
    $this->session_var_admin = Config::get("multilanguage::lang_options.session_var_admin");
  }

  /**
   * Translate a string to the current language
   *
   * @param String $str
   * @param String $filename
   * @return String
   */
  public function t($str, $filename = "template") {
    $this->forceUpdateLocale();

    $key = "{$filename}.{$str}";
    $transl = Lang::get($key);

    if ($transl != $key) {
      return $transl;
    }

    return $this->strict_mode ? '' : $str;
  }

  public function enableStrictMode() {
    $this->strict_mode = true;
    return $this;
  }

  public function disableStrictMode() {
    $this->strict_mode = false;
    return $this;
  }

  /**
   * Obtain the current language:default if not set
   *
   * @return String
   */
  public function get() {
    return $this->locator->get();
  }

  /**
   * Sets the current client language
   *
   * @param String $lingua
   * @return mixed
   */
  public function set($lang) {
    return $this->locator->set($lang);
  }

  /**
   * Updates Laravel locale
   */
  public function forceUpdateLocale() {
    App::setLocale($this->get());
  }

  public function updateLocale() {
    $this->locator->updateLocale();
  }

  /**
   * @return Array
   */
  public function getList() {
    return Config::get('multilanguage::base.languages');
  }

  /**
   * @param \Palmabit\Multilanguage\Classes\LanguageLocator $locator
   */
  public function setLocator($locator) {
    $this->locator = $locator;
  }

  /**
   * @param String $session_name
   */
  public function setSessionName($session_name) {
    $this->locator->setSessionName($session_name);
  }

  /**
   * Obtain the default fallback language to use
   * ad description when doesn't find the
   * current language description
   *
   * @return mixed
   */
  public function getDefault() {
    return Config::get('multilanguage::base.default_fallback_language');
  }
}