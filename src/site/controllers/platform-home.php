<?php

return function($kirby, $pages, $page, $site) 
{
    $platform = $kirby->controller('platform' , compact('page', 'pages', 'kirby', 'site'));
    $phases=$site->index()->filterBy('template','phase');
    return A::merge($platform,compact('phases'));    
};