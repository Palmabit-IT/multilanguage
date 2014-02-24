<?php namespace Palmabit\Multilanguage\Interfaces;
/**
 * Interface UrlTranslatorInterface
 *
 * @author jacopo beschi jacopo@jacopobeschi.com
 */
interface UrlTranslatorInterface
{

    /**
     * Traduce url da action name
     * @param nome action
     * @param $params parametri
     * @return mixed
     */
    public function action($name, $params);
    /**
     * Traduce url da to name
     * @param nome action
     * @param $params parametri
     * @return mixed
     */
    public function to($name, $params);
}