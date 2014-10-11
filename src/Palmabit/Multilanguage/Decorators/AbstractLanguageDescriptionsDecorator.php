<?php  namespace Palmabit\Multilanguage\Decorators;

use Palmabit\Multilanguage\Interfaces\DecoratorInterface;
use L;

abstract class AbstractLanguageDescriptionsDecorator implements DecoratorInterface {

  protected $null_resource_name = '';
  protected $descriptions_field_name = '';
  protected $resource;
  protected $null_resource;
  protected $current_lang;
  protected $default_lang;
  /**
   * With strict mode the decorator only tries to find the current_language
   * description otherwise returns a null object
   *
   * @var bool
   */
  protected $strict_mode = false;

  public function __construct($resource, $current_lang = null) {
    if (empty($this->descriptions_field_name)) {
      throw new \Exception("You cannot instantiate this decorator without setting descriptions_field_name field.");
    }

    if (empty($this->null_resource_name)) {
      throw new \Exception("You cannot instantiate this decorator without setting null_resource_name field.");
    }

    $this->current_lang = $current_lang ? : L::get();
    $this->default_lang = L::getDefault();
    $this->resource = $resource;
    $this->null_resource = new $this->null_resource_name($this, $this->current_lang);
  }

  /**
   * @param mixed $resource
   */
  public function setResource($resource) {
    $this->resource = $resource;
  }

  /**
   * @return mixed
   */
  public function getResource() {
    return $this->resource;
  }

  /**
   * @return mixed
   */
  public function getDescriptionFieldName() {
    return $this->descriptions_field_name;
  }

  public function __get($key) {
    if (property_exists($this->resource, $key)) {
      return $this->resource->$key;
    }

    $current_description = $this->findDescriptionForLang($this->current_lang);

    return $current_description->$key;
  }

  public function __set($key, $value) {
    if (property_exists($this, $key)) {
      return $this->$key = $value;
    }

    if (property_exists($this->resource, $key)) {
      return $this->resource->$key = $value;
    }

    $this->setDescriptionValue($key, $value);
  }

  /**
   * @param $current_lang
   * @return null
   */
  public function findDescriptionForLang($current_lang) {
    $default_description = $this->null_resource;

    foreach ($this->resource->{$this->descriptions_field_name} as $description) {
      if ($description->lang == $this->default_lang) {
        $default_description = $description;
      }
      if ($description->lang == $current_lang) {
        return $description;
      }
    }

    return $this->strict_mode ? $this->null_resource : $default_description;
  }

  /**
   * @param $key
   * @param $value
   * @return null
   */
  protected function setDescriptionValue($key, $value) {
    $description = $this->findDescriptionForLang($this->current_lang);
    $description->$key = $value;

    return $description;
  }

  /**
   * @param       $method
   * @param array $params
   * @return mixed
   */
  public function __call($method, array $params = []) {
    return call_user_func_array([$this->resource, $method], $params);
  }

  /**
   * @return mixed
   */
  public function getCurrentLang() {
    return $this->current_lang;
  }

  /**
   * @return mixed
   */
  public function getDefaultLang() {
    return $this->default_lang;
  }

  /**
   * @param mixed $current_lang
   */
  public function setCurrentLang($current_lang) {
    $this->current_lang = $current_lang;
  }

  /**
   * @param mixed $default_lang
   */
  public function setDefaultLang($default_lang) {
    $this->default_lang = $default_lang;
  }

  public function enableStrictMode() {
    $this->strict_mode = true;

    return $this;
  }

  public function disableStrictMode() {
    $this->strict_mode = false;

    return $this;
  }
}