<?php namespace Palmabit\Multilanguage\Traits;
use L;

trait LanguageHelper
{
    /**
     * Obtain the current lang
     *
     * @return String lingua
     */
    public function getLingua()
    {
        return $this->is_admin ? L::get_admin() : L::get();
    }

    /**
     * {@inheritdoc}
     */
    public function generaSlugLingua($input)
    {
        return $input["slug"];
    }
}