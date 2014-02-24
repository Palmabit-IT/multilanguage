<?php namespace Palmabit\Multilanguage\Interfaces;

interface MultilinguaRepositoryInterface
{
    /**
     * Ottiene la lingua
     * @return String lingua
     */
    public function getLingua();
    /**
     * Ottiene la risorsa partendo dallo slug lingua
     * @param $slug_lingua
     * @return mixed
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function findBySlugLingua($slug_lingua);
    /**
     * Genera lo slug lingua dall'input
     * @oaram $input
     * @return String
     */
    public function generaSlugLingua($input);
}