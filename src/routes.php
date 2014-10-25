<?php
Route::post('/lang/change/{new_lang}', 'Palmabit\Multilanguage\Controllers\LangController@change');
Route::post('/lang/current', function () {return L::get();});
Route::post('/lang/changeAdmin/{new_lang}','Palmabit\Multilanguage\Controllers\LangController@changeAdmin');

/*
|--------------------------------------------------------------------------
| API REST
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'api'], function () {

  /**
   * Version 1
   */
  Route::group(['prefix' => '/v1'], function () {
    //GET current lang
    Route::get('/lang', function () {return ['lang' => L::get()];});

    //POST current lang
    Route::post('/lang', 'Palmabit\Multilanguage\Controllers\LangController@changeRest');

    //PUT current lang
    Route::put('/lang/{new_lang}', 'Palmabit\Multilanguage\Controllers\LangController@changeRest');
  });
});
