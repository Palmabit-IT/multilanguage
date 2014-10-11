<?php
namespace Palmabit\Multilanguage\Classes\Commands\Translation;

interface SaverInterface {
  public function save();
  public function setMatchedData($matched);
  public function setOutputDirectory($path);
}