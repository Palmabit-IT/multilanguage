<?php  namespace Palmabit\Multilanguage\Classes\Traits;

trait LanguageHelperTrait {
  public function hasBeenTranslated() {
    return count($this->descriptions) > 1;
  }

  public function hasTranslation($lang) {
    foreach ($this->descriptions as $description) {
      if ($description->lang == $lang) {
        return true;
      }
    }

    return false;
  }
} 