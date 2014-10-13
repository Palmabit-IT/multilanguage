<?php
/*
  |--------------------------------------------------------------------------
  | Multilanguage filters
  |--------------------------------------------------------------------------
  | automatic language swap filter
  */
// This filter change language on every request if a language is given
$all_languages = L::getList();
/**
 * @return mixed
 */
if (!function_exists('getLanguageString')) {
  function getLanguageString() {
    return array_values(explode('/', Request::path()))[0];
  }
}
/**
 * @param $lang
 * @param $all_languages
 * @return bool
 */
if (!function_exists('needToChangeLanguage')) {
  function needToChangeLanguage($lang, $all_languages) {
    return in_array($lang, array_keys($all_languages)) && L::get() != $lang;
  }
}
if (needToChangeLanguage(getLanguageString(), $all_languages)) {
  L::set(getLanguageString());
}
