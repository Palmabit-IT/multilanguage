<?php  namespace Palmabit\Multilanguage\Tests\Controllers;

use L;
use Palmabit\Multilanguage\Tests\TestCase;

class LangControllerTest extends TestCase  {
  /**
   * @test
   **/
  public function swapCurrentLanguage()
  {
    $new_lang = 'us';
    L::shouldReceive('set')->once()->with($new_lang);

    $this->action('POST', 'Palmabit\Multilanguage\Controllers\LangController@change', ['new_lang' => $new_lang]);
  }
}