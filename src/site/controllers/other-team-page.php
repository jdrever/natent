<?php
use carefulcollab\helpers as helpers;
return function($kirby, $pages, $page, $site) 
{
    $requiresLogin=true;
    $isNonLearningJourneyPage=true;
    $platform = $kirby->controller('platform' , compact('kirby', 'pages', 'page', 'site', 'requiresLogin', 'isNonLearningJourneyPage'));
    if (get('teamId'))
    {
        $viewedTeam = helpers\DataHelper::getTeamByTeamId(get('teamId'));
        $editTeam=false;        
    }
    return $kirby->controller('team', compact('platform', 'site', 'viewedTeam', 'editTeam'));

    
};