<?php  namespace Palmabit\Multilanguage\Classes\Commands\Translation;

use Illuminate\Filesystem\Filesystem;

class Saver implements SaverInterface {

  protected $output_dir;
  protected $data;
  protected $file_manager;
  protected $formatter;

  public function __construct(FormatterInterface $formatter, $file_manager = null) {
    $this->formatter = $formatter;
    $this->file_manager = $file_manager ? : new Filesystem();
  }

  public function save() {
    foreach ($this->data as $filename => $language_data) {
//      var_export($language_data);die;
      $this->file_manager->put($this->getFilePath($filename), $this->formatter->setContent($language_data)->format());
    }
  }

  /**
   * @param $filename
   * @return string
   */
  protected function getFilePath($filename) {
    return $this->output_dir . $filename;
  }

  public function setMatchedData($matched) {
    $this->data = $matched;
  }

  public function setOutputDirectory($path) {
    $this->output_dir = $path;
  }

  /**
   * @return string
   */
  public function getOutputDirectory() {
    return base_path($this->output_dir);
  }

  /**
   * @param null $file_manager
   */
  public function setFileManager($file_manager) {
    $this->file_manager = $file_manager;
  }

  /**
   * @return null
   */
  public function getFileManager() {
    return $this->file_manager;
  }
}