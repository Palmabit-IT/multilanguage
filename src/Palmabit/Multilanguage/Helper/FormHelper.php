<?php
if ( ! function_exists('get_path_bandierina'))
{
    function get_form_select_lingue($is_admin = 1)
    {
        $form = Form::open(["method" => "post", "action" => 'Multilingua\Controllers\LinguaController@swapLingua', "id" => "form-select-lingue"]);
        // prelievo dati per la lingua
        $lista_lingue = Config::get('lista_lingue');
        $lingua_corrente = $is_admin ? L::get_admin() : L::get();
        // select lingua
        $form.= Form::label("lang", "Cambia lingua");
        $form.= Form::select("lang", $lista_lingue, $lingua_corrente , ["class"=> "form-control", "id" => "select-lingue"] );
        // usato per verificare quale lingua modificare
        $form.= Form::hidden("is_admin", $is_admin);
        $form.= Form::close();

        return $form;
    }
}

if ( ! function_exists('get_bandierina_corrente'))
{
    function get_bandierina_corrente()
    {
        return get_path_bandierina(L::get());
    }
}

    if ( ! function_exists('get_cat_select_arr'))
{
    function get_path_bandierina($sigla)
    {
        $path_base = Config::get('opzioni_lingue.path_base_bandierine');
        $estensione = Config::get('opzioni_lingue.estensione_img_bandierine');
        return $path_base.$sigla.".{$estensione}";
    }
}

    if ( ! function_exists('get_lista_bandierine'))
{
    function get_lista_bandierine()
    {
        $lista_lingue = Config::get('lista_lingue');
        foreach($lista_lingue as $key => $value)
        {
            $bandierine[$key] = ["{$value}" => get_path_bandierina($key)];
        }

        return $bandierine;
    }
}