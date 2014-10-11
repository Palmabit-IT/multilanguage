<?php  namespace Palmabit\Multilanguage\Classes\Commands\Translation;

class IlluminateFormatter implements FormatterInterface {

  protected $content;

  public function __construct($content = null) {
    if ($content) {
      $this->content = $content;
    }
  }

  public function setContent($content) {
    $this->content = $content;
    return $this;
  }

  public function format() {
    return $this->getStringRappresentation($this->fixgetStringRappresentationAddingExtraSlashes());
  }

  /**
   * @return string
   */
  protected function getStringRappresentation($data) {
    return '<?php return ' . var_export($data, true) . ';';
  }

  /**
   * @return array
   */
  protected function fixgetStringRappresentationAddingExtraSlashes() {
    return array_combine(array_map('stripslashes', array_keys($this->content)), array_map('stripslashes', $this->content));
  }
}