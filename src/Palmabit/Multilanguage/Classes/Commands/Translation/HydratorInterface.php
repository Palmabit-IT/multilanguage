<?php
namespace Palmabit\Multilanguage\Classes\Commands\Translation;

interface HydratorInterface {
  public function hydrate();

  /**
   * @param null $matched_data
   */
  public function setMatchedData($matched_data);
}