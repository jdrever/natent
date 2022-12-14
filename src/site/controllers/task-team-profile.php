<?php
use carefulcollab\helpers as helpers;
return function($kirby, $pages, $page, $site) {
    $requiresLogin=true;
    $platform = $kirby->controller('platform' , compact('page', 'pages', 'kirby', 'site','requiresLogin'));
    $team=$platform['team'];
    $country=$platform['country'];
    
    if($kirby->request()->is('POST')) 
    {
        $description = htmlspecialchars(get('description'));
        $skills = implode(',', get('skills',''));
        $result=helpers\DataHelper::updateTeamProfile($team['user_id'], $description, $skills);

        return $kirby->controller('result' , compact('page', 'site', 'result','country'));
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