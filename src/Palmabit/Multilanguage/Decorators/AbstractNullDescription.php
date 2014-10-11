<?php  namespace Palmabit\Multilanguage\Decorators;

abstract class AbstractNullDescription {

  public $lang;
  protected $decorator;
  protected $resource;
  protected $descriptions_field_name;
  protected $description_class = '';

  public function __construct($decorator, $lang) {
    if (empty($this->description_class)) {
      throw new \Exception("You need to set description_attribute field in your class");
    }

    $this->decorator = $decorator;
    $this->resource = $this->decorator->getResource();
    $this->descriptions_field_name = $this->decorator->getDescriptionFieldName();
    $this->lang = $lang;
  }

  public function __get($key) {
    return '';
  }

  public function __set($key, $value) {
    $description = new $this->description_class();

    if (!property_exists($description, $key)) {
      return;
    }

    $description->lang = $this->lang;
    $description->$key = $value;
    $this->resource->{$this->descriptions_field_name}[] = $description;
  }

  public function getResource() {
    return $this->resource;
  }

  public function getDescriptionsFieldName() {
    return $this->descriptions_field_name;
  }
}