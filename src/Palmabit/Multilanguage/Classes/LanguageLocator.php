<?php  namespace Palmabit\Multilanguage\Classes;

use Config;
use Session;
use Illuminate\Support\Facades\Auth;

class LanguageLocator {

  protected $anonymous_default;
  protected $session_name;
  protected $locales;

  function __construct() {
    $this->anonymous_default = Config::get('multilanguage::base.anonymous_default');
    $this->session_name = Config::get('multilanguage::base.session_name');
    $this->locales = Config::get('multilanguage::base.locales');
  }

  public function get() {
    if ($language_preference = $this->getSessionTemporaryPreference()) {
      return $language_preference;
    }

    if ($preferred_language = $this->getLoggedUserPreferredLanguage()) {
      return $preferred_language;
    }

    return $this->anonymous_default;
  }

  /**
   * @return bool
   */
  protected function getLoggedUserPreferredLanguage() {
    return (Auth::user() && Auth::user()->preferred_language) ? Auth::user()->preferred_language : false;
  }

  /**
   * @return mixed
   */
  protected function getSessionTemporaryPreference() {
    return Session::has($this->session_name) ? Session::get($this->session_name) : false;
  }

  public function set($value) {
    Session::set($this->session_name, $value);
    $this->updateLocale();
  }

  public function updateLocale() {
    setlocale(LC_TIME, $this->getLocaleAssociated());
  }

  /**
   * @param mixed $session_name
   */
  public function setSessionName($session_name) {
    $this->session_name = $session_name;
  }

  /**
   * @return mixed
   */
  public function getSessionName() {
    return $this->session_name;
  }

  /**
   * @return mixed
   */
  protected function getLocaleAssociated() {
    return isset($this->locales[$this->get()]) ? $this->locales[$this->get()] : 0;
  }
}