<?php
use carefulcollab\helpers as helpers;

return function($kirby, $pages, $page, $site) 
{
    $platform = $kirby->controller('platform' , compact('page', 'pages', 'kirby'));

    $team=$platform['team'];
    $phaseCompletion=[];
    $phases = helpers\DataHelper::getPhasesByCountryId($team['country_id']);
    $latestComments=helpers\DataHelper::getLatestComments($team['user_id']);
    $latestAppreciations=helpers\DataHelper::getLatestAppreciations($team['user_id']);

    foreach ($phases as $nextPhase)
    {
        $phase[0] = $nextPhase['phase_title'];
        $phaseCompletionInfo=helpers\DataHelper::getCompletionByPhaseTypeForTeam($team['id'],$nextPhase['phase_type']);
        $phase[1] = $phaseCompletionInfo['percent_complete'];
        $phaseCompletion[]=$phase;
    }


    return A::merge($platform,
    [ 
        'viewedTeam'=>$platform['team'], 
        'editTeam'=>true, 
        'phaseCompletion'=>$phaseCompletion, 
        'latestComments'=>$latestComments,
        '$latestAppreciations'=>$latestAppreciations
    ]);
    
};