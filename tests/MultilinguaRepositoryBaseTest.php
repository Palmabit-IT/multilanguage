<?php  namespace Palmabit\Multilanguage\Tests;
use L;
use Mockery as m;
use Palmabit\Multilanguage\Classes\MultilinguaRepositoryBase;

/**
 * Test MultilinguaRepositoryBaseTest
 *
 * @author jacopo beschi jacopo@jacopobeschi.com
 */
class MultilinguaRepositoryBaseTest extends TestCase {

  public function tearDown()
  {
    m::close();
  }

  /**
   * @test
   **/
  public function canGetAllModels()
  {
    $this->mockLanguageGet();
    $expected_data  = '_';
    $mock_model_all = m::mock('StdClass')
              ->shouldReceive('all')
              ->once()
              ->andReturn($expected_data)
              ->getMock();
    $mock_model_get = m::mock('StdClass')
            ->shouldReceive('get')
            ->once()
            ->andReturn($mock_model_all)
            ->getMock();
    $model_stub = new ModelStub($mock_model_get);

    $is_admin   = true;
    $repository = new MultilinguaRepoStub($is_admin, $model_stub);

    $repository->all();
  }

  /**
   * @test
   **/
  public function canFindModel()
  {
    $expected_data = '_';
    $mock_find = m::mock('StdClass')
              ->shouldReceive('findOrFail')
              ->once()
              ->andReturn($expected_data)
              ->getMock();
    $is_admin = true;
    $repository = new MultilinguaRepoStub($is_admin, $mock_find);

    $id = 1;
    $repository->find($id);
  }

  /**
   * @test
   **/
  public function itUpdateModelAndIgnoresSlugLingua()
  {
    $data = ["slug_lingua" => "ignored"];
    $expected_data = [];
    $expected_ret = 'expected obj returned';
    $model_update_mock = m::mock('StClass');
    $model_update_mock->shouldReceive('update')
      ->once()
      ->with($expected_data)
      ->andReturn($expected_ret);

    $mock_find = m::mock('StdClass')
                  ->shouldReceive('findOrFail')
                  ->once()
                  ->andReturn($model_update_mock)
                  ->getMock();

    $is_admin   = true;
    $repository = new MultilinguaRepoStub($is_admin, $mock_find);

    $id = 1;
    $repository->update($id, $expected_data);

  }

  private function mockLanguageGet()
  {
    L::shouldReceive('get_admin')->andReturn('language');
  }

}

class MultilinguaRepoStub extends MultilinguaRepositoryBase{
    public function findBySlugLang($slug_lang){}
}

class ModelStub {
  protected $return_value;
  protected static $return_value_static;

  public function __construct($return_value)
  {
    $this->return_value = $return_value;
    static::$return_value_static = $return_value;
  }

  public function __call($name, $arguments)
  {
    return $this->return_value;
  }

  public static function __callStatic($name, $arguments)
  {
    return static::$return_value_static;
  }
}