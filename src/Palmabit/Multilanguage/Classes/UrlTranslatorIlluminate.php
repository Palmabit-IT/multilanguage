<?php namespace Palmabit\Multilanguage\Classes;

use Palmabit\Multilanguage\Interfaces\action;
use Palmabit\Multilanguage\Interfaces\parametri;
use Palmabit\Multilanguage\Interfaces\se;
use Palmabit\Multilanguage\Interfaces\UrlTranslatorInterface;
use URL;
use L;

class UrlTranslatorIlluminate implements UrlTranslatorInterface{

    /**
     * Translates url from action name
     *
     * @param nome     action
     * @param $params  parametri
     * @return mixed
     * @todo test
     */
    public function action($name, $params = null)
    {
        var_dump(L::t($name));
        dd(L::get());
        return $this->base("action", L::t($name), $params);
    }

    /**
     * Translates a to url
     *
     * @param nome     action
     * @param $params  parametri
     * @return mixed
     */
    public function to($name, $params = null)
    {
        return $this->base("to", L::t($name), $params);
    }

    /**
     * Base url translator
     * @param      $type
     * @param      $name
     * @param null $params
     * @return string
     */
    protected function base($type, $name, $params)
    {
        $base_url = URL::to('/');
        $new_url = "{$base_url}/".L::get();
        $desired_url = URL::$type($name, $params);
        $last_url = substr($desired_url,strlen($base_url));
        $new_url.= $last_url;
        // baseurl/lingua/parte_finale
        return $new_url;
    }
}