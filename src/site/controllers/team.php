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
    
    foreach ($phases as $nextPhase)
    {
        $pagesInPhase=$site->index()->filterBy('template', 'guide')->filterBy('phase', strtolower($nextPhase->title()));
        if ($pageInPhase=$pagesInPhase->first())
        {
            $phase[0] = $pageInPhase->title();
            $phaseCompletionInfo=helpers\DataHelper::getCompletionByPhaseTypeForTeam($viewedTeam['id'],$nextPhase->title());
            $phase[1] = $phaseCompletionInfo['percent_complete'];
            $phaseCompletion[]=$phase;

            $pointsInPhase=$pageInPhase->index()->filterBy('template','^=', 'task');
            foreach ($pointsInPhase as $point)
            {
                $collaborationPoints[]=$point;
            }
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
        'skills'));

}
?>