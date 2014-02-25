<?php namespace Palmabit\Multilanguage\Traits;
use L;

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
    public function generateSlugLang($input)
    {
        return $input["slug"];
    }
}