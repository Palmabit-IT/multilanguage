<?php namespace Palmabit\Multilanguage\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use L, App;
use Palmabit\Multilanguage\Classes\Exceptions\LanguageNotPresentException;

class LangController extends Controller {

  public function change($new_lang) {
    L::set($new_lang);
  }

  public function changeAdmin($new_lang) {
    L::set_admin($new_lang);
  }
  public function changeRest($new_lang = null) {
    if (is_null($new_lang)) {
      $input = Input::get();

      if (empty($input) || !isset($input['lang'])) {
        return Response::json(['message' => L::t('Wrong data, "lang" missing')], 400);
      }

      $new_lang = $input['lang'];
    }

    try {
      return [
              'success' => true,
              'lang'    => L::set($new_lang)
      ];
    } catch (LanguageNotPresentException $e) {
      return Response::json(['message' => $e->getMessage()], 400);
    }
  }
}
