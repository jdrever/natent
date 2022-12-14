<?php

return function($kirby, $pages, $page, $site) 
{
    $requiresLogin=true;
    $isNonLearningJourneyPage=true;
    $platform = $kirby->controller('platform' , compact('kirby', 'pages', 'page', 'site', 'requiresLogin', 'isNonLearningJourneyPage'));
    $viewedTeam=$platform['team'];
    $editTeam=true;
    return $kirby->controller('team', compact('platform', 'site', 'viewedTeam', 'editTeam'));

    
};