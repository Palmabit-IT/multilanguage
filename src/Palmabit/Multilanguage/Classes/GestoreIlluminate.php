<?php namespace Palmabit\Multilanguage\Classes;
/**
 * Class Gestore
 *
 * @package Auth
 * @author jacopo beschi
 */
use Palmabit\Multilanguage\Interfaces\GestoreInterface;
use Lang;
use App;
use Config;
use Session;

class GestoreIlluminate implements GestoreInterface{

    /**
     * Variable name to save in sessione
     * @var String
     */
    protected $session_var;
    /**
     * Variable name to save in session for admin panel handling
     * @var String
     */
    protected $session_var_admin;

    public function __construct()
    {
        $this->session_var = Config::get("multilanguage::lang_options.session_var");
        $this->session_var_admin = Config::get("multilanguage::lang_options.session_var_admin");
    }
    /**
     * Translate a string to the current language
     *
     * @param String $stringa
     * @param String $file file dal quale prelevare la traduzione
     * @return String
     */
    public function t($stringa, $file = "template")
    {
        $key = "{$file}.{$stringa}";
        $transl = Lang::get($key);
        // se non trova la traduzione ritorna la stringa
        return ($transl == $key) ? $stringa : $transl;
    }

    /**
     * Obtain the current language:default if not set
     *
     * @return String
     */
    public function get()
    {
        return Session::get($this->session_var, Config::get("multilanguage::lang_options.default") );
    }

    /**
     * Obtain the current admin language:default if not set
     *
     * @return String
     */
    public function get_admin()
    {
        return Session::get($this->session_var_admin, Config::get("multilanguage::lang_options.default") );
    }

    /**
     * Sets the current client language
     *
     * @param String $lingua
     * @return mixed
     */
    public function set($lang)
    {
        Session::put($this->session_var, $lang);
    }

    /**
     * Sets the current admin language
     *
     * @param String $lingua
     * @return mixed
     */
    public function set_admin($lang)
    {
        Session::put($this->session_var_admin, $lang);
    }

    /**
     * Obtain the list of all supported languages
     *
     * @return Array
     */
    public function get_lista()
    {
        return Config::get('multilanguage::lang_list');
    }

    /**
     * Updates Laravel locale
     */
    public function aggiornaLocale()
    {
        App::setLocale($this->get());
    }

    /**
     * {@inheritdoc}
     */
    public function get_descrizione_admin()
    {
        $prefix = $this->get_admin();
        return Config::get('multilanguage::lang_list.'.$prefix);
    }

    /**
     * {@inheritdoc}
     */
    public function get_descrizione()
    {
        $prefix = $this->get();
        return Config::get('multilanguage::lang_list.'.$prefix);
    }
}