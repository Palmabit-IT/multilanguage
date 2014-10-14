<?php namespace Palmabit\Multilanguage\Helpers;

use Illuminate\Support\Facades\Request;
use App, L, Route;
use BadMethodCallException;

class HreflangHelper {

  public static function get() {
    $url = App::make('url');
    $root = $url->getRequest()->root();
    $decodedPath = $url->getRequest()->decodedPath();
    $langs = L::getList();
    $hreflangs = [];

    $path = HreflangHelper::getPath($decodedPath);
    $translated_paths = HreflangHelper::getTranslatedPaths($path, $langs);

    foreach ($translated_paths as $lang => $translated_path) {
      $hreflangs[$lang] = HreflangHelper::createHreflang($root, $translated_path, $lang);
    }

    return $hreflangs;
  }

  protected static function createHreflang($root, $path, $lang) {
    return $root . '/' . $lang . '/' . $path;
  }

  public static function getLanguage($decodedPath = null) {
    if (is_null($decodedPath) || !is_string($decodedPath)) {
      throw new BadMethodCallException;
    }

    return substr($decodedPath, 0, 2);
  }

  public static function getPath($decodedPath = null) {
    if (is_null($decodedPath) || !is_string($decodedPath)) {
      throw new BadMethodCallException;
    }

    return substr($decodedPath, 3, strlen($decodedPath));
  }

  protected static function getTranslatedPaths($path, $langs) {
    $translated_paths = [];
    foreach ($langs as $key => $lang) {
      $translated_paths[$key] = $path;
    }

    return $translated_paths;
  }
}