<?php  namespace Palmabit\Multilanguage\Tests\Helpers;

use Palmabit\Multilanguage\Helpers\HreflangHelper;
use Palmabit\Multilanguage\Tests\TestCase;

class HreflangHelperTest extends TestCase {

  /**
   * @test
   * @expectedException \BadMethodCallException
   **/
  public function canHandleExceptionIfUrlIsNull() {
    $lang = HreflangHelper::getLanguage();
  }

  /**
   * @test
   * @expectedException \BadMethodCallException
   **/
  public function canHandleExceptionIfUrlIsNotString() {
    $lang = HreflangHelper::getLanguage(1);
  }

  /**
   * @test
   * @expectedException \BadMethodCallException
   **/
  public function canHandleExceptionIfPathIsNull() {
    $lang = HreflangHelper::getPath();
  }

  /**
   * @test
   * @expectedException \BadMethodCallException
   **/
  public function canHandleExceptionIfPathIsNotString() {
    $lang = HreflangHelper::getPath(1);
  }

  /**
   * @test
   **/
  public function canGetLanguagePrefix() {
    $url = 'it/page';
    $lang = HreflangHelper::getLanguage($url);

    $this->assertEquals($lang, 'it');
  }

  /**
   * @test
   **/
  public function canGetDecodedPath() {
    $url = 'it/page/detail';
    $path = HreflangHelper::getPath($url);

    $this->assertEquals($path, 'page/detail');
  }
}
 