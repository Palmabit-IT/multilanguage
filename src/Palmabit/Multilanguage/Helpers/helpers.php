<?php
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Form;

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