<?php namespace Palmabit\Multilanguage\Controllers;

use Illuminate\Routing\Controller;
use L;

class LangController extends Controller {

  public function change($new_lang) {
    L::set($new_lang);
  }
}
