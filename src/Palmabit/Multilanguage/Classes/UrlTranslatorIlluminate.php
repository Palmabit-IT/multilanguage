<?php namespace Multilingua\Classes;

use Multilingua\Interfaces\action;
use Multilingua\Interfaces\parametri;
use Multilingua\Interfaces\se;
use Multilingua\Interfaces\UrlTranslatorInterface;
use URL;
use L;

class UrlTranslatorIlluminate implements UrlTranslatorInterface{

    /**
     * Traduce url da action name
     *
     * @param nome     action
     * @param $params  parametri
     * @return mixed
     * @todo test
     */
    public function action($name, $params = null)
    {
        return $this->base("action", $name, $params);
    }

    /**
     * Traduce url da to name
     *
     * @param nome     action
     * @param $params  parametri
     * @return mixed
     * @todo test
     */
    public function to($name, $params = null)
    {
        return $this->base("to", $name, $params);
    }

    /**
     * Generatore base di url che si appoggia ad URL
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