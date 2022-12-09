<?php
use carefulcollab\helpers as helpers;
return function($kirby, $pages, $page, $site) {

    $platform = $kirby->controller('platform' , compact('page', 'pages', 'kirby'));
    $team=$platform['team'];

    
    if($kirby->request()->is('POST')) 
    {
        $description = htmlspecialchars(get('description'));
        $skills = implode(',', get('skills',''));
        $result=helpers\DataHelper::updateTeamProfile($team['user_id'], $description, $skills);

        return $kirby->controller('result' , compact('page', 'site', 'result'));
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