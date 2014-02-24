<?php namespace Palmabit\Multilanguage\Tests;

use Mockery as m;
use L;
use Lang;
use Config;

class GestoreTest extends TestCase {

    public function tearDown()
    {
        m::close();
    }

    public function testGetSetWorks()
    {
        $lingua = "l";
        L::set($lingua);
        $check_lingua = L::get();

        $this->assertEquals($check_lingua, $lingua);
    }

    public function testGetSetAdminWorks()
    {
        $lingua = "l";
        L::set_admin($lingua);
        $check_lingua = L::get_admin();

        $this->assertEquals($check_lingua, $lingua);
    }

    public function testTWorks()
    {
        $stringa = "str";
        $file = "f";
        Lang::shouldReceive('get')->once()->with("{$file}.{$stringa}");

        L::t($stringa,$file);
    }

    public function testGetDescrizioneWorks()
    {
        $prefisso = "it";
        L::set($prefisso);
        $desc_expected = "italiano";

        $app = m::mock('AppMock');
        $app->shouldReceive('instance')->once()->andReturn($app);

        \Illuminate\Support\Facades\Facade::setFacadeApplication($app);
        \Illuminate\Support\Facades\Config::swap($config = m::mock('ConfigMock'));

        Config::shouldReceive([
                                  'get' => '',
                                  'get' => $desc_expected
                              ]);
        $desc = L::get_descrizione();
        $this->assertEquals($desc, $desc_expected);
    }

}