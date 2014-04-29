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

    /**
     * {@inheritdoc}
     */
    public function updateSlugLang(&$input, $object)
    {
        if (empty($object->slug) && isset($input['slug_lang']) )
        {
            $input['slug_lang'] = $this->generateSlugLang($input);
        }
        else
        {
            unset($input['slug_lang']);
        }
    }

}