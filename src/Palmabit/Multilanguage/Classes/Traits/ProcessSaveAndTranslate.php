<?php  namespace Palmabit\Multilanguage\Classes\Traits;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

trait ProcessSaveAndTranslate {

  public function handleTranslationFlashData() {
    if ($this->isSaveAndTranslate()) {
      $this->flashSelectFlags();
    } else {
      $this->flashSuccess();
    }
  }

  /**
   * @return mixed
   */
  protected function isSaveAndTranslate() {
    return isset($this->data["translate_active"]) && $this->data["translate_active"];
  }

  protected function flashSuccess() {
    Session::flash('flash_message', Config::get($this->process_success_message_name));
  }

  protected function flashSelectFlags() {
    Session::flash(static::$save_and_translate_name, true);
  }
} 