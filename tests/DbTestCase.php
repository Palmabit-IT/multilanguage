<?php  namespace Palmabit\Multilanguage\Tests;
/**
 * Class DbTestCase
 *
 * @author jacopo beschi j.beschi@palmabit.com
 */
use Artisan;
use DB;
class DbTestCase extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $artisan = $this->app->make( 'artisan' );

        $this->populateDB($artisan);
    }

    /**
     * @test
     **/
    public function it_mock_test()
    {
        $this->assertTrue(true);
    }

    /**
     * @deprecated used for old mysql test
     */
    protected function cleanDb()
    {
        $manager = DB::getDoctrineSchemaManager();
        $tables = $manager->listTableNames();

        DB::Statement("SET FOREIGN_KEY_CHECKS=0");
        foreach ($tables as $key => $table) {
            DB::Statement("DROP TABLE ".$table."");
        }
        DB::Statement("SET FOREIGN_KEY_CHECKS=1");
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application    $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        // reset base path to point to our package's src directory
        $app['path.base'] = __DIR__ . '/../src';

        $mysql_conn = array(
            'driver'    => 'mysql',
            'host'      => 'localhost',
            'database'  => 'palmabit_base_test',
            'username'  => 'root',
            'password'  => 'root',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        );

        $sqlite_conn = array(
            'driver'    => 'sqlite',
            'database'  => ':memory:',
            'prefix'    => '',
        );

        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', $sqlite_conn);
    }

    /**
     * @param $artisan
     */
    protected function populateDB($artisan)
    {
        $artisan->call('migrate', [
                                  "--database" => "testbench", '--path' => '../src/migrations', '--seed' => '']);
    }
} 