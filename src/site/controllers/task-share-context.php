<?php
use carefulcollab\helpers as helpers;
return function($kirby, $pages, $page, $site) {
    $requiresLogin=false;
    $platform = $kirby->controller('platform' , compact('page', 'pages', 'kirby', 'site','requiresLogin'));
    $team=$platform['team'];
    $country=$platform['country'];
    $userLoggedIn=$platform['userLoggedIn'];

    if($kirby->request()->is('POST')) 
    {
        $context = htmlspecialchars(get('context'));

        $result = helpers\DataHelper::updateTeamWithStatementAndContext($team['user_id'], "", $context);

        $userId=$platform['userId'];
        $phaseType=$platform['phaseType'];
        return $kirby->controller('result', compact('page', 'site', 'kirby', 'result','country','userId','phaseType'));
    }
    else
    {
        if ($userLoggedIn)
        {
            $teamContext=isset($team['context']) ? $team['context'] : '';
        }
        else
        {
            $exampleTeam=helpers\DataHelper::getTeamByTeamId($platform['exampleTeam']);
            $teamContext=isset($exampleTeam['context']) ? $exampleTeam['context'] : '';
        }
        return A::merge($platform, compact('teamContext'));
    }
};