### Utilizzo Multilingua
il tutto è contenuto nella directory eccetto:
- file di conrigurazione: app/config/opzioni_lingue, app/config/lista_lingue
- il filtro globale che setta la lingua a runtime: app filters.php: vedi before che inizializza la lingua ogni chiamata all'app
- inoltre c'è un filtro che cambia lingua in base all'argomento fornito in input
- vedere nel file routes php come si utilizza