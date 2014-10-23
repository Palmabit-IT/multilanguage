<?php

Route::post('/lang/change/{new_lang}','Palmabit\Multilanguage\Controllers\LangController@change');
Route::post('/lang/current',function(){return L::get();});
Route::post('/lang/changeAdmin/{new_lang}','Palmabit\Multilanguage\Controllers\LangController@changeAdmin');
