<?php

return [
  /*
  |--------------------------------------------------------------------------
  | Language availables
  |--------------------------------------------------------------------------
  | The description has to be written in the
  | anonymous_default language which is also the
  | translator default language
  |
  */
  "languages"         => [
          "it" => "italian",
          "en" => "english",
          "de" => "german",
          "fr" => "french"
  ],
  /*
  |--------------------------------------------------------------------------
  | Language locales
  |--------------------------------------------------------------------------
  | The locale associated with a given language string
  |
  */
  "locales" => [
    "it" => "it_IT",
    "en" => "en_US"
  ],
  /*
  |--------------------------------------------------------------------------
  | Anonymous user default language
  |--------------------------------------------------------------------------
  |
  */
  "anonymous_default" => "it",
  /*
  |--------------------------------------------------------------------------
  | Session variable name
  |--------------------------------------------------------------------------
  |
  */
  "session_name"      => "current_lang",
  /*
  |--------------------------------------------------------------------------
  | Default fallback language
  |--------------------------------------------------------------------------
  | This is the default fallback language to use
  | if doesn't find any translation in the current
  | language
  */
  "default_fallback_language"      => "it",
];