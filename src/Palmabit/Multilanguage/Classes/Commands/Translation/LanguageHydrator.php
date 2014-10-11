<?php  namespace Palmabit\Multilanguage\Classes\Commands\Translation;

use App;
use Illuminate\Support\Facades\Lang;

class LanguageHydrator implements HydratorInterface {

  protected $matched_data;
  protected $data;
  protected $languages;
  protected $translator;
  /**
   * The prefix of the filename that will be saved in the directory
   *
   * @var string
   */
  protected $file_prefix = "template_";

  public function __construct($matched_data = null, $translator = null) {
    $this->matched_data = $matched_data;
    $this->translator = $translator ? : App::make('multilanguage');
    $this->languages = $this->getDefaultLanguages();
  }

  /**
   * @param null $matched_data
   */
  public function setMatchedData($matched_data) {
    $this->matched_data = $matched_data;
    return $this;
  }

  /**
   * @param mixed $languages
   */
  public function setLanguages($languages) {
    $this->languages = $languages;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getLanguages() {
    return $this->languages;
  }

  /**
   * @param null $translator
   */
  public function setTranslator($translator) {
    $this->translator = $translator;
  }

  /**
   * @return null
   */
  public function getTranslator() {
    return $this->translator;
  }

  public function hydrate() {

    $data = [];
    foreach ($this->languages as $lang => $description) {
      $data[$this->getSaveFileName($lang)] = $this->hydrateDataOfGivenLanguage($lang);
    }
    return $data;
  }

  protected function hydrateDataOfGivenLanguage($lang) {
    $this->translator->set($lang);

    $hydrated_data = [];
    foreach ($this->matched_data as $key => $matched_value) {
      $hydrated_data[$matched_value] = $this->translator->enableStrictMode()->t($this->handleEscapedChars($matched_value));
    }

    asort($hydrated_data);

    return $hydrated_data;
  }

  protected function getSaveFileName($lang) {
    return $this->file_prefix . $lang . '.php';
  }

  protected function getDefaultLanguages() {
    return $this->translator->getList();
  }

  /**
   * @param $matched_value
   * @return string
   */
  protected function handleEscapedChars($matched_value) {
    return stripslashes($matched_value);
  }
}