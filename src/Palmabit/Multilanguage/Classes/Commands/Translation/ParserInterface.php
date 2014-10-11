<?php
namespace Palmabit\Multilanguage\Classes\Commands\Translation;

interface ParserInterface {
  public function parseAllContent();

  public function openDirectory($path);

  public function parseContentOfFile($path);

  public function open($path);
}