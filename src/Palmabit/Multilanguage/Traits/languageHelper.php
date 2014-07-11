<?php namespace Palmabit\Multilanguage\Traits;
use L;
use App;
use Palmabit\Library\Exceptions\NotFoundException;

trait LanguageHelper
{
    /**
     * Obtain the current lang
     *
     * @return String lingua
     */
    public function getLang()
    {
        return $this->is_admin ? L::get_admin() : L::get();
    }

    /**
     * {@inheritdoc}
     */
    public function updateSlugLang(&$input, $object)
    {
        if ($this->needsToUpdateSlugLang($input, $object))
        {
            $input['slug_lang'] = $this->generateSlugLang($input);
        }
        else
        {
            unset($input['slug_lang']);
        }
    }

    /**
     * @param $input
     * @param $object
     * @return bool
     */
    private function needsToUpdateSlugLang (&$input, $object) {
        return $this->slugLangIsNotObsolete($input, $object) &&
               (! $this->slugLangAlreadyExistsWithThatLanguage($input));
    }

    /**
     * @param $input
     * @return bool
     */
    private function slugLangAlreadyExistsWithThatLanguage (&$input) {
        $product_repository = App::make('product_repository');
        try {
            $product_repository->findBySlugLang($this->generateSlugLang($input));
        }
        catch (NotFoundException $e) {
            return false;
        }

        return true;
    }

    /**
     * @param $input
     * @param $object
     * @return bool
     */
    private function slugLangIsNotObsolete (&$input, $object) {
        return empty($object->slug) && isset($input['slug_lang']);
    }

    /**
     * {@inheritdoc}
     */
    public function generateSlugLang($input)
    {
        return $input["slug"];
    }


}