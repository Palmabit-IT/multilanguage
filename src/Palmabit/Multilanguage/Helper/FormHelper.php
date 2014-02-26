<?php
if ( ! function_exists('get_form_select_lang'))
{
    function get_form_select_lang($is_admin = 1)
    {
        $form = Form::open(["method" => "post", "action" => 'Palmabit\Multilanguage\Controllers\LangController@swapLang', "id" => "form-select-lang"]);
        // prelievo dati per la lingua
        $lang_list = Config::get('multilanguage::lang_list');
        $current_lang = $is_admin ? L::get_admin() : L::get();
        // select language
        $form.= Form::label("lang", "Cambia lingua");
        $form.= Form::select("lang", $lang_list, $current_lang , ["class"=> "form-control", "id" => "select-lang"] );
        // soo see check which type of lang needs to change
        $form.= Form::hidden("is_admin", $is_admin);
        $form.= Form::close();

        return $form;
    }
}

if ( ! function_exists('get_current_flag'))
{
    function get_current_flag()
    {
        return get_path_bandierina(L::get());
    }
}

    if ( ! function_exists('get_path_flag'))
{
    function get_path_flag($sigla)
    {
        $path_base = Config::get('opzioni_lingue.path_base_bandierine');
        $estensione = Config::get('opzioni_lingue.estensione_img_bandierine');
        return $path_base.$sigla.".{$estensione}";
    }
}

    if ( ! function_exists('get_flags_list'))
{
    function get_flags_list()
    {
        $lista_lingue = Config::get('lista_lingue');
        foreach($lista_lingue as $key => $value)
        {
            $bandierine[$key] = ["{$value}" => get_path_bandierina($key)];
        }

        return $bandierine;
    }
}