<?php

Route::filter('MultilinguaSwapFilter', function(){
    $lista_lingue = L::get_lista();
    $lingua = array_values(explode('/', Request::path()))[0];
    if(in_array($lingua, array_keys($lista_lingue) ) )
    {
        // if not blocked
        if(! Session::get('noswap'))
        {
            // updates the language
            L::set($lingua);
            L::aggiornaLocale();
        }
    }
    else
    {
        // not found
        app::abort('404');
    }
});