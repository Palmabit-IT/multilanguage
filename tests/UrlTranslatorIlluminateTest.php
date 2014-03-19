<?php  namespace Palmabit\Multilanguage\Tests; 

/**
 * Test UrlTranslatorIlluminateTest
 *
 * @author jacopo beschi j.beschi@palmabit.com
 */
use L, App;
use Palmabit\Multilanguage\Classes\UrlTranslatorIlluminate;

class UrlTranslatorIlluminateTest extends TestCase {

    /**
     * @test
     **/
    public function it_translates_to()
    {
        L::shouldReceive('get')
            ->once()
            ->andReturn('en')
            ->shouldReceive('t')
            ->andReturn('prova');
        $transl =  new UrlTranslatorIlluminate();
        $url = $transl->to('prova');
        $this->assertContains('/en/prova', $url);
    }
}
 