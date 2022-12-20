<?php
use carefulcollab\helpers as helpers;
return function($kirby, $pages, $page, $site) {
    $requiresLogin = true;
    $platform = $kirby->controller('platform' , compact('page', 'pages', 'kirby', 'site', 'requiresLogin'));
    $team = $platform['team'];
    $country = $platform['country'];
    
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
        return A::merge($platform, [
            'showForm' => true
        ]);
    }
};