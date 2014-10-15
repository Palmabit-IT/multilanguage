<?php  namespace Palmabit\Multilanguage\Classes;

use App;
use Route;

class UrlWrapper {

  protected $generator;

  public function __construct($url = null) {
    $this->generator = $url ? : App::make('url');
    $this->translator = App::make('multilanguage');
  }

  public function to($url, $translate = false, $language = null) {
    $url = $this->removeStartingSlash($this->clearExistingLanguageStrings($url));

    return $translate ? $this->generator->to($this->getCurrentLanguage($language) . '/' . $url) : $this->generator->to($url);
  }

  /**
   * @return mixed
   */
  protected function getCurrentLanguage($language = null) {
    return $language ?: $this->translator->get();
  }

  public function __call($method, array $params = []) {
    return call_user_func_array([$this->generator, $method], $params);
  }

  /**
   * @param $url
   * @return string
   */
  protected function clearExistingLanguageStrings($url) {
    foreach ($this->translator->getList() as $lang => $description) {
      $lang_prefix = "{$lang}";
      if (($index = $this->isStartingWith($url, $lang_prefix)) !== false) {
        $url = substr($url, $index + strlen($lang_prefix), strlen($url));
      }
    }
    return $url;
  }

  /**
   * @param $url
   * @return string
   */
  protected function removeStartingSlash($url) {
    if ($url[0] == '/') {
      $url = substr($url, 1);
      return $url;
    }
    return $url;
  }

  /**
   * @param $url
   * @param $lang_prefix
   * @return int
   */
  protected function isStartingWith($url, $lang_prefix) {
    $language_start_index = strrpos(substr($url, 0, 3), $lang_prefix);
    if (strlen($url) <= ($language_start_index + strlen($lang_prefix)) || ($url[$language_start_index + strlen($lang_prefix)] == "/"))
    {
      return $language_start_index;
    }

    return false;
  }
}