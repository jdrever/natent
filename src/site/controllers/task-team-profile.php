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
        $result=helpers\DataHelper::updateTeamProfile(404, $description, $skills);

        if ($result->wasSuccessful)
        {
            $pointsToAdd = 20;
            if ($page = $page->next())
            {
                $page->go(['query' => ['status' => 'ok', 'points' =>$pointsToAdd ]]);
            }
        }
        else
        {
            //return $platform;
            if ($page=$site->find('error'))
                $page->go([ 'query' => ['errorMessage' => isset($result->errorMessage) ? $result->errorMessage : 'No error message returned']]);
        }
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