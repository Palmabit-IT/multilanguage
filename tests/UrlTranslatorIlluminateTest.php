<?php  namespace Palmabit\Multilanguage\Tests; 

/**
 * Test UrlTranslatorIlluminateTest
 *
 * @author jacopo beschi j.beschi@palmabit.com
 */
use L;
use Palmabit\Multilanguage\Classes\UrlTranslatorIlluminate;

class UrlTranslatorIlluminateTest extends TestCase {

    /**
     * @test
     **/
    public function it_translates_to()
    {
        L::shouldReceive('get')->andReturn('en');
        $transl =  new UrlTranslatorIlluminate();
        $url = $transl->to('prova');
        $this->assertContains('/en/prova', $url);
    }
}
 