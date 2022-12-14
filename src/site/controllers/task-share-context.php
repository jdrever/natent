<?php
use carefulcollab\helpers as helpers;
return function($kirby, $pages, $page, $site) {
    $requiresLogin=true;
    $platform = $kirby->controller('platform' , compact('page', 'pages', 'kirby', 'site','requiresLogin'));
    $team=$platform['team'];
    $country=$platform['country'];

    if($kirby->request()->is('POST')) 
    {
        $context = htmlspecialchars(get('context'));

        $result = helpers\DataHelper::updateTeamWithStatementAndContext($team['user_id'], "", $context);

        return $kirby->controller('result' , compact('page', 'site', 'result', 'country'));
    }
    else
    {
        return A::merge($platform, [
            'showForm' => true
        ]);
    }
};