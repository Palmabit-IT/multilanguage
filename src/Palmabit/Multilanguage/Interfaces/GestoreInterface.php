<?php namespace Multilingua\Interfaces;

interface GestoreInterface
{
    /**
     * Traduce una stringa nella lingua corrente
     * @param String $stringa
     * @param String $file file dal quale prelevare la traduzione
     * @return String
     */
    public function t($stringa, $file);

    /**
     * Ottene la lingua corrente: default se non è settata
     * @return String
     */
    public function get();

    /**
     * Ottiene la lingua corrente utilizzata nel pannello amministrazione
     * @return mixed
     */
    public function get_admin();

    /**
     * Setta la lingua corrente
     * @param String $lingua
     * @return mixed
     */
    public function set($lingua);

    /**
     * Setta la lingua corrente nel pannello amministrazione
     * @param String $lingua
     * @return mixed
     */
    public function set_admin($lingua);


    /**
     * Ottiene la lista di tutte le lingue
     * @return Array
     */
    public function get_lista();

    /**
     * Ottiene la descrizione della lingua
     * @return mixed
     */
    public function get_descrizione();

    /**
     * Ottiene la descrizione della lingua admin
     * @return mixed
     */
    public function get_descrizione_admin();
}