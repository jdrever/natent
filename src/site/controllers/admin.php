<?php
return function($kirby, $pages, $page, $site) 
{
    $requiresLogin=true;
    $isNonLearningJourneyPage=true;
    return $kirby->controller('platform' , compact('kirby', 'pages', 'page', 'site', 'requiresLogin', 'isNonLearningJourneyPage'));
    
};