<?php

return function($kirby, $pages, $page, $site) 
{
    $callingPage=$_SERVER['HTTP_REFERER'];
    if ($kirby->request()->is('POST'))
    {

      $action = $_POST['action'];
      if ($action==='select-country')
      {
        Cookie::set("adminCountry",$_POST['countryId']);
      }
      if ($action==='select-location')
      {
        Cookie::set("adminLocation",$_POST['locationId']);
      }
    }
    go($callingPage);
};
