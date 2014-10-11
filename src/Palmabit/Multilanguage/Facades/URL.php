<?php  namespace Palmabit\Multilanguage\Facades;

use Illuminate\Support\Facades\Facade;

class URL extends Facade{
  protected static function getFacadeAccessor() { return 'urltranslator'; }
} 