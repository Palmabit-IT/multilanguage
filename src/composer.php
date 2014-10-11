<?php

View::composer('*', function($view)
{
  $view->with('languages', L::getList());
  $view->with('current_language', L::get());
});

// languages links for select-language
View::composer('multilanguage::select-language', function($view){
  $urls=[];
  foreach(L::getList() as $lang => $description)
  {
    $urls[URL::to(Request::decodedPath(),true,$lang)] = $description;
  }
  $view->with('urls',$urls);
});
