<?php
use carefulcollab\helpers as helpers;
return function($kirby, $pages, $page, $site) 
{
    $platform = $kirby->controller('platform' , compact('page', 'pages', 'kirby', 'site'));
    $userId=$platform['userId'];
    $phases=$site->index()->filterBy('template','phase');
    $latestComments=helpers\DataHelper::getLatestComments($userId);
    $latestAppreciations=helpers\DataHelper::getLatestAppreciations($userId);
    return A::merge($platform,compact('phases','latestComments','latestAppreciations'));    
};