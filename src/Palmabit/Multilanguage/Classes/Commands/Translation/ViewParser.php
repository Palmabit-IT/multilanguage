<?php  namespace Palmabit\Multilanguage\Classes\Commands\Translation;

use Illuminate\Filesystem\Filesystem;

class ViewParser implements ParserInterface {

  protected $file_manager;
  protected $content;
  /**
   * List of regex used for parsing the field
   *
   *@var array
   */
  protected $parse_regex = [
          '/L::t\("(.*?)"\)/',
          '/L::t\([\'](.*?)[\']\)/'
  ];
  protected $matches;

  function __construct($file_manager = null) {
    $this->file_manager = $file_manager ? : new Filesystem();
  }

  public function open($path) {
    $this->content[realpath($path)] = $this->file_manager->get($path);
  }

  public function openDirectory($path) {
    foreach ($this->file_manager->allFiles($path) as $file_path) {
      $this->open($file_path->getRealPath());
    }
  }

  /**
   * @return mixed
   */
  public function getContent() {
    return $this->content;
  }

  /**
   * @return mixed
   */
  public function getContentOfFile($file) {
    return $this->content[$file];
  }

  /**
   * @param mixed $content
   */
  public function setContent($content) {
    $this->content = $content;
  }

  /**
   * @param mixed $parse_regex
   */
  public function setParseRegex(array $parse_regex) {
    $this->parse_regex = $parse_regex;
  }

  /**
   * @return mixed
   */
  public function getParseRegex() {
    return $this->parse_regex;
  }

  public function parseAllContent() {
    $matches = [];
    foreach (array_keys($this->content) as $path) {
      $matches = $this->mergeAndUniquifyMatches($matches, $path);
    }
    return $this->matches = $matches;
  }

  public function parseContentOfFile($path) {
    $results = [];
    foreach ($this->parse_regex as $parse_regex) {
      preg_match_all($parse_regex, $this->content[$path], $file_matches);
      $results = array_merge($results, $file_matches[1]);
    }

    return $this->matches = $results;
  }

  /**
   * @return mixed
   */
  public function getMatches() {
    return $this->matches;
  }

  /**
   * @param mixed $matches
   */
  public function setMatches($matches) {
    $this->matches = $matches;
  }

  /**
   * @param $matches
   * @param $path
   * @return array
   */
  protected function mergeAndUniquifyMatches($matches, $path) {
    return array_unique(array_merge($matches, $this->parseContentOfFile($path)));
  }
}