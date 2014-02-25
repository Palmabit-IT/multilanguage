<?php namespace Palmabit\Multilanguage\Interfaces;

interface MultilinguaRepositoryInterface
{
    /**
     *
     * @return String lingua
     */
    public function getLang();
    /**
     * Search by slug lang
     * @param $slug_lingua
     * @return mixed
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function findBySlugLang($slug_lingua);
    /**
     * Generate slug lang given the input
     * @oaram $input
     * @return String
     */
    public function generateSlugLang($input);
}