<?php namespace Palmabit\Multilanguage\Interfaces;

interface GestoreInterface {
  /**
   * Translate a given string

   *
*@param String $str
   * @param String $filename
   * @return String
   */
  public function t($str, $filename);

  /**
   * Obtain the current language
   *
   * @return String
   */
  public function get();

  /**
   * Override the current language
   *
   * @param String $lang
   * @return mixed
   */
  public function set($lang);
  /**
   * Obtain all the languages as an array key value
   * where $key is the two letter symbol and value is the
   * long description e.g. italiano
   * @return Array
   */
  public function getList();
  /**
   * Obtain the default fallback language to use
   * ad description when doesn't find the
   * current language description
   * @return mixed
   */
  public function getDefault();
}