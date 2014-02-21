<?php namespace Multilingua\Classes;
/**
 * Class Gestore
 *
 * @package Auth
 * @author jacopo beschi
 */
use Multilingua\Interfaces\GestoreInterface;
use Lang;
use App;
use Config;
use Session;

class GestoreIlluminate implements GestoreInterface{

    /**
     * Nome variabile da salvare in sessione
     * @var String
     */
    protected $session_var;
    /**
     * Nome variabile salvata in sessione per il pannello admin
     * @var String
     */
    protected $session_var_admin;

    public function __construct()
    {
        $this->session_var = Config::get("opzioni_lingue.session_var");
        $this->session_var_admin = Config::get("opzioni_lingue.session_var_admin");
    }
    /**
     * Traduce una stringa nella lingua corrente
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
     * Ottene la lingua corrente: default se non è settata
     *
     * @return String
     */
    public function get()
    {
        return Session::get($this->session_var, Config::get("opzioni_lingue.default") );
    }

    /**
     * Ottene la lingua corrente nel pannello admin: default se non è settata
     *
     * @return String
     */
    public function get_admin()
    {
        return Session::get($this->session_var_admin, Config::get("opzioni_lingue.default") );
    }

    /**
     * Setta la lingua corrente
     *
     * @param String $lingua
     * @return mixed
     */
    public function set($lingua)
    {
        Session::put($this->session_var, $lingua);
    }

    /**
     * Setta la lingua corrente nel pannello admin
     *
     * @param String $lingua
     * @return mixed
     */
    public function set_admin($lingua)
    {
        Session::put($this->session_var_admin, $lingua);
    }

    /**
     * Ottiene la lista di tutte le lingue
     *
     * @return Array
     */
    public function get_lista()
    {
        return Config::get('lista_lingue');
    }

    /**
     * Aggiorna il locale di laravel
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
        $prefisso = $this->get_admin();
        return Config::get('lista_lingue.'.$prefisso);
    }

    /**
     * {@inheritdoc}
     */
    public function get_descrizione()
    {
        $prefisso = $this->get();
        return Config::get('lista_lingue.'.$prefisso);
    }
}