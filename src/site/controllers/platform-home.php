<?php

return function($kirby, $pages, $page, $site) 
{
    $platform = $kirby->controller('platform' , compact('page', 'pages', 'kirby'));
    $countries=$site->index()->filterBy('template', 'country');
    if (Cookie::exists('country'))
    {
        $country=Cookie::get('country');
    }
    else
    {
        $language=$kirby->language()->code();    
        $country=$countries->findBy('language', $language)->title();
    }

    $phases=$site->index()->filterBy('template','phase');
    return A::merge($platform,compact('countries','country', 'phases'));    
};