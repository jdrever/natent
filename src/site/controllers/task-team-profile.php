<?php
use carefulcollab\helpers as helpers;
return function($kirby, $pages, $page, $site) {

    $platform = $kirby->controller('platform' , compact('page', 'pages', 'kirby'));
    $team=$platform['team'];

    
    if($kirby->request()->is('POST')) 
    {
        $description = htmlspecialchars($_POST['description']);
        $skills = '';
        if (isset($_POST['skills'])) $skills = implode(',', $_POST['skills']);
        $result=helpers\DataHelper::updateTeamProfile($team['id'], $description, $skills);

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