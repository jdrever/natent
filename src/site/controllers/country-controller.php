<?php
use carefulcollab\helpers as helpers;

return function($kirby, $pages, $page, $site) 
{
    $callingPage=$_SERVER['HTTP_REFERER'];
    $country = $_GET['country'];
    Cookie::set('country',$country);

    Response::go($callingPage);
};

