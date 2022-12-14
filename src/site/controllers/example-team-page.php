<?php
use carefulcollab\helpers as helpers;
return function($kirby, $pages, $page, $site) 
{
    $requiresLogin=false;
    $isNonLearningJourneyPage=true;
    $hideCollaboration=true;
    $platform = $kirby->controller('platform' , compact('kirby', 'pages', 'page', 'site', 'requiresLogin', 'isNonLearningJourneyPage'));
    if ($platform['exampleTeam'])
    {
        $viewedTeam = helpers\DataHelper::getTeamByTeamId($platform['exampleTeam']);
        $editTeam=false;
        $hideCollaboration=true;
        return $kirby->controller('team', compact('platform', 'site', 'viewedTeam', 'editTeam', 'hideCollaboration'));  
    }
    $site->find('error')->go([ 'query' => ['errorMessage' => 'No example team has been setup']]);
    
};