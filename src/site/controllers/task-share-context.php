<?php
use carefulcollab\helpers as helpers;
return function($kirby, $pages, $page, $site) {

    $platform = $kirby->controller('platform' , compact('page', 'pages', 'kirby'));
    $team=$platform['team'];

    if($kirby->request()->is('POST')) 
    {
        // IF data in add to commons area? 
        // - helpers\DataHelper::addResourcesToCommons()
        // - $team['id'], $resources, $phaseType,$collaborationPointType

        $context = htmlspecialchars(get('context'));

        $result = helpers\DataHelper::updateTeamWithStatementAndContext($team['user_id'], "", $context);

        return $kirby->controller('result' , compact('page', 'site', 'result'));
    }
    else
    {
        return A::merge($platform, [
            'showForm' => true
        ]);
    }
};