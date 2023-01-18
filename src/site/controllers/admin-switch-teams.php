<?php
use carefulcollab\helpers as helpers;

return function($kirby, $pages, $page, $site) {
    $requiresLogin = true;

    $platform = $kirby->controller('platform' , compact('page', 'pages', 'kirby', 'site', 'requiresLogin'));
    $team = $platform['team'];
    $userId = $platform['userId'];
    $country = $platform['country'];
    $result = '';
    if($kirby->request()->is('POST')) 
    {
        $actionType="change to your current Team";
        $userId=$_POST['userId'];
        $teamId=$_POST['teamId'];
        $result=helpers\DataHelper::updateTeamForUser($userId, $teamId);
        $platform['team']=helpers\DataHelper::getTeamByWPUserId($userId);
    }

    $teams = helpers\DataHelper::getTeamsByRole($userId); 
    return A::merge($platform, compact( 'teams', 'result'));
};