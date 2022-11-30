<?php
use carefulcollab\helpers as helpers;
return function($kirby, $pages, $page) {
    # Grab the data from the default controller
    $platform = $kirby->controller('platform' , compact('page', 'pages', 'kirby'));
    $team=$platform['team'];

    
    if($kirby->request()->is('POST')) 
    {
        $description = htmlspecialchars($_POST['description']);
        $skills = '';
        if (isset($_POST['skills'])) $skills = implode(',', $_POST['skills']);
        $result=helpers\DataHelper::updateTeamProfile($team['user_id'], $description, $skills);
        $pointsToAdd = 20;

        if ($page = $page->next()){
            return [ 'nextPage' => $page->go(['query' => ['status' => 'ok', 'points' =>$pointsToAdd ]])];
        }
    }
    else
    {
        $skills=helpers\DataHelper::getSkillsets();
        return [
            'description' => $team['description'],
            'skills' => $skills,
            'teamSkills' =>$team['skills'],
            'showForm' => true
        ];
    }
};