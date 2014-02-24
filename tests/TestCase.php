<?php namespace Palmabit\Multilanguage\Tests;
/**
 * Test TestCase
 *
 * @author jacopo beschi jacopo@jacopobeschi.com
 */
class TestCase extends \Orchestra\Testbench\TestCase  {

    public function setUp()
    {
        parent::setUp();

        require_once __DIR__ . "/../src/routes.php";
    }

    protected function getPackageProviders()
    {
        return [
                'Palmabit\Multilanguage\MultilanguageServiceProvider',
            ];
    }

}
 