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

        if ($userLoggedIn)
        {
            $teamDescription=isset($team['description']) ? $team['description'] : '';
            $teamSkills=isset($team['skills']) ? $team['skills'] : '';
        }
        else
        {
            $exampleTeam=helpers\DataHelper::getTeamByTeamId($platform['exampleTeam']);
            $teamDescription=isset($exampleTeam['description']) ? $exampleTeam['description'] : '';
            $teamSkills=isset($exampleTeam['skills']) ? $exampleTeam['skills'] : '';
        }
        return A::merge($platform, compact('skills','teamSkills', 'teamDescription'));
    }
};