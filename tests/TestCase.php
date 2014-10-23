<?php namespace Palmabit\Multilanguage\Tests;

use Config;

class TestCase extends \Orchestra\Testbench\TestCase {

  public function setUp() {
    parent::setUp();
    require_once __DIR__ . "/../src/routes.php";
    $this->useMailPretend();
  }

  protected function getPackageProviders() {
    return [
            'Palmabit\Multilanguage\MultilanguageServiceProvider',
    ];
  }

  /**
   * @test
   **/
  public function dummy() {
  }

  protected function useMailPretend()
  {
    Config::set('mail.pretend', true);
  }
}
 