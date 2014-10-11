<?php namespace Palmabit\Multilanguage\Interfaces;

interface DecoratorInterface {
  /**
   * @return mixed
   */
  public function getResource();

  public function __construct($resource);

  /**
   * @param mixed $resource
   */
  public function setResource($resource);
}