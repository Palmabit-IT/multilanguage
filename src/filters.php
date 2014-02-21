<?php

Route::filter('MultilinguaSwapFiltro', function(){
    $lista_lingue = L::get_lista();
    $lingua = array_values(explode('/', Request::path()))[0];
    if(in_array($lingua, array_keys($lista_lingue) ) )
    {
        // se non ho bloccato lo swap lingua
        if(! Session::get('noswap'))
        {
            // aggiorna la lingua
            L::set($lingua);
            L::aggiornaLocale();
        }
    }
    else
    {
        // non trova la route
        app::abort('404');
    }
});


use Multilingua\Helper\TranslateHelper;
/**
 * Traduce in automatico lo slug al cambio di lingua
 */
Route::filter('TranslateSlugCat', function($route){
    $nuovo_slug = TranslateHelper::translateSlug($route->getParameter("slug"), 'categoria');
    $route->setParameter("slug", $nuovo_slug);
});

/**
 * Traduce in automatico lo slug al cambio di lingua
 */
Route::filter('TranslateSlugProd', function($route){
    $nuovo_slug = TranslateHelper::translateSlug($route->getParameter("slug"), 'prodotto');
    $route->setParameter("slug", $nuovo_slug);
});