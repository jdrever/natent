<?php
use carefulcollab\helpers as helpers;
return function($kirby, $pages, $page, $site) 
{
    $requiresLogin=false;
    $isNonLearningJourneyPage=true;
    $platform = $kirby->controller('platform' , compact('kirby', 'pages', 'page', 'site', 'requiresLogin', 'isNonLearningJourneyPage'));
    $userId=$platform['userId'];
    $phases=$site->index()->filterBy('template','phase');
    $latestComments=helpers\DataHelper::getLatestComments($userId);
    $latestAppreciations=helpers\DataHelper::getLatestAppreciations($userId);

    return A::merge($platform,compact('phases','latestComments','latestAppreciations'));    
};