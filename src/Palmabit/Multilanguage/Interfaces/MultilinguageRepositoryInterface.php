<?php namespace Palmabit\Multilanguage\Interfaces;

interface MultilinguageRepositoryInterface
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

    /**
     * Removes slug lang for updates incase already exists
     * @param $input
     * @param $object
     * @return mixed
     */
    public function updateSlugLang($input, $object);
}