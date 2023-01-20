<?php
use carefulcollab\helpers as helpers;
return function($kirby, $pages, $page, $site) {
    $requiresLogin = false;
    $platform = $kirby->controller('platform' , compact('page', 'pages', 'kirby', 'site', 'requiresLogin'));
    $team = $platform['team'];
    $country = $platform['country'];
    $userLoggedIn=$platform['userLoggedIn'];
    
    if($kirby->request()->is('POST')) 
    {
        $recommendations = htmlspecialchars(get('recommendations'));
        $result = helpers\DataHelper::updateTeamWithMeasures($team['user_id'], $recommendations);
        $userId=$platform['userId'];
        $phaseType=$platform['phaseType'];
        return $kirby->controller('result', compact('page', 'site', 'kirby', 'result','country','userId','phaseType'));
    }
    else
    {
        if ($userLoggedIn)
        {
            $teamArea=$team['area'];
            $teamRecommendations=isset($team['recommendations']) ? $team['recommendations'] : '';

        }
        else
        {
            $exampleTeam=helpers\DataHelper::getTeamByTeamId($platform['exampleTeam']);
            $teamArea=$exampleTeam['area'];
            $teamRecommendations=isset($exampleTeam['recommendations']) ? $exampleTeam['recommendations'] : '';
        }
        return A::merge($platform,compact('teamArea','teamRecommendations'));
    }
};