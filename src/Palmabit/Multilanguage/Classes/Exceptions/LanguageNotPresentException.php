<?php  namespace Palmabit\Multilanguage\Classes\Exceptions; 

class LanguageNotPresentException extends \Exception {

  public function __construct() {
    parent::__construct('Selected lang does not exist');
  }
} 