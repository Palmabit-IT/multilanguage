<?php  namespace Palmabit\Multilanguage\Classes\Commands\Translation;

class Manager {

  protected $parser;
  protected $saver;
  protected $hydrator;

  public function __construct(ParserInterface $parser, HydratorInterface $hydrator, SaverInterface $saver) {
    $this->parser = $parser;
    $this->saver = $saver;
    $this->hydrator = $hydrator;
  }

  public function open($path) {
    $this->parser->openDirectory($path);
    return $this;
  }

  public function setOutputDirectory($path) {
    $this->saver->setOutputDirectory($path);
    return $this;
  }

  public function save() {
    $this->saver->setMatchedData($this->hydrator->setMatchedData($this->parser->parseAllContent())->hydrate());
    $this->saver->save();
  }

}