<?php
use carefulcollab\helpers as helpers;
return function($kirby, $pages, $page, $site) {
    $requiresLogin=false;
    $platform = $kirby->controller('platform' , compact('page', 'pages', 'kirby', 'site','requiresLogin'));
    $team=$platform['team'];
    $country=$platform['country'];
    
    if($kirby->request()->is('POST')) 
    {
        $description = htmlspecialchars(get('description'));
        $skills = implode(',', get('skills',''));
        $result=helpers\DataHelper::updateTeamProfile($team['user_id'], $description, $skills);

        $userId=$platform['userId'];
        $phaseType=$platform['phaseType'];
        return $kirby->controller('result', compact('page', 'site', 'kirby', 'result','country','userId','phaseType'));
    }
    else
    {
        $skills=helpers\DataHelper::getSkillsets();
        return A::merge($platform, [
            'skills' => $skills,
            'showForm' => true
        ]);
    }
};