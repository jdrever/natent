<?php
use carefulcollab\helpers as helpers;
return function($platform, $viewedTeam, $editTeam) 
{
    $userId=$platform['userId'];
    $phaseCompletion=[];


    $phases = helpers\DataHelper::getPhasesByCountryId($viewedTeam['country_id']);

    $latestComments=($editTeam) ? helpers\DataHelper::getLatestComments($userId) : [];
    $latestAppreciations=($editTeam) ? helpers\DataHelper::getLatestAppreciations($userId) : [];
    
    foreach ($phases as $nextPhase)
    {
        $phase[0] = $nextPhase['phase_title'];
        $phaseCompletionInfo=helpers\DataHelper::getCompletionByPhaseTypeForTeam($viewedTeam['id'],$nextPhase['phase_type']);
        $phase[1] = $phaseCompletionInfo['percent_complete'];
        $phaseCompletion[]=$phase;
    }
    $skills=helpers\DataHelper::getSkillsets();


    return A::merge($platform, compact(
        'viewedTeam',
        'editTeam', 
        'phaseCompletion', 
        'latestComments',
        'latestAppreciations',
        'skills'));

}
?>