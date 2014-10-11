<?php

View::composer('*', function($view)
{
  $view->with('languages', L::getList());
  $view->with('current_language', L::get());
});