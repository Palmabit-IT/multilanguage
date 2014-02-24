### Utilizzo Multilingua
il tutto è contenuto nella directory eccetto:
- file di conrigurazione: lang_list e lang_options
- il filtro globale che setta la lingua a runtime: app filters.php: vedi before che inizializza la lingua ogni chiamata all'app
- inoltre c'è un filtro che cambia lingua in base all'argomento fornito in input
- nel routes.php mettere: Route::group( ['before'=>'MultilinguaSwapFiltro', 'prefix' => '{lang?}'], function(){});
