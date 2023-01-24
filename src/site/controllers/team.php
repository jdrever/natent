<?php
use carefulcollab\helpers as helpers;

return function($platform, $site, $viewedTeam, $editTeam, $hideCollaboration=false) 
{
    $userId=$platform['userId'];
    $phaseCompletion=[];

    $collaborationPoints=[];

    $phases=$site->index()->filterBy('template','phase');

    $latestComments=($editTeam) ? helpers\DataHelper::getLatestComments($userId) : [];
    $latestAppreciations=($editTeam) ? helpers\DataHelper::getLatestAppreciations($userId) : [];

    $pointsAuditTrail=helpers\DataHelper::getPointsAuditTrail($viewedTeam['id']); 

    $languagePage=$platform['languagePage'];
    
    foreach ($phases as $nextPhase)
    {
        $phasePage = $languagePage->index()->filterBy('phase', strtolower($nextPhase->title()))->first();
 
        $phase[0] = $phasePage->title();
        $phaseCompletionInfo=helpers\DataHelper::getCompletionByPhaseTypeForTeam($viewedTeam['id'],$nextPhase->title());
        $phase[1] = $phaseCompletionInfo['percent_complete'];
        $phaseCompletion[]=$phase;

        $pointsInPhase=$phasePage->index()->filterBy('template','^=', 'task');
        foreach ($pointsInPhase as $point)
        {
            $collaborationPoints[]=$point;
        }
        
    }
    $skills=helpers\DataHelper::getSkillsets();


    return A::merge($platform, compact(
        'viewedTeam',
        'editTeam', 
        'hideCollaboration',
        'phaseCompletion', 
        'collaborationPoints',
        'latestComments',
        'latestAppreciations',
        'skills',
        'pointsAuditTrail'));

}
?>