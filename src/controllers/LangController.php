<?php namespace Palmabit\Multilanguage\Controllers;

use BaseController;
use Input;
use Redirect;
use L;

class LangController extends BaseController {

    public function swapLang()
	{
        $lingua = Input::get('lang');
        $is_admin = Input::get('is_admin');

        if($is_admin) L::set_admin($lingua);
        else L::set($lingua);

        // redirect con blocco swap automatico lingua
        return Redirect::back()->with(["noswap"=> true]);
    }

}
