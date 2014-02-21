<?php namespace Multilingua\Traits;
use L;

trait LanguageHelper
{
    /**
     * Ottiene la lingua corrente
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