<?php

return function($kirby, $pages, $page, $site) 
{
    $requiresLogin=false;
    $isNonLearningJourneyPage=true;
    return $kirby->controller('platform' , compact('kirby', 'pages', 'page', 'site', 'requiresLogin', 'isNonLearningJourneyPage'));  
};