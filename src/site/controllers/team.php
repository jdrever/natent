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

    $profileAppreciations=helpers\DataHelper::getAppreciationsByContentId($userId,'Team Profile', $viewedTeam['profile_id']);
    $profileComments=helpers\DataHelper::getCommentsByContentId($userId,'Team Profile', $viewedTeam['profile_id']);
    $challengeAppreciations=helpers\DataHelper::getAppreciationsByContentId($userId,'Team Challenge', $viewedTeam['team_challenge_id']);
    $challengeComments=helpers\DataHelper::getCommentsByContentId($userId,'Team Challenge', $viewedTeam['team_challenge_id']);
    $contextAppreciations=helpers\DataHelper::getAppreciationsByContentId($userId,'Challenge Definition', $viewedTeam['team_challenge_definition_id']);
    $contextComments=helpers\DataHelper::getCommentsByContentId($userId,'Challenge Definition', $viewedTeam['team_challenge_definition_id']);
    $designAppreciations=helpers\DataHelper::getAppreciationsByContentId($userId,'Design Idea', $viewedTeam['team_design_idea_id']);
    $designComments=helpers\DataHelper::getCommentsByContentId($userId,'Design Idea', $viewedTeam['team_design_idea_id']);
    $measureAppreciations=helpers\DataHelper::getAppreciationsByContentId($userId,'Measures', $viewedTeam['team_measures_id']);
    $measureComments=helpers\DataHelper::getCommentsByContentId($userId,'Measures', $viewedTeam['team_measures_id']);
    $pitchAppreciations=helpers\DataHelper::getAppreciationsByContentId($userId,'Business Canvas', $viewedTeam['team_business_canvas_id']);
    $pitchComments=helpers\DataHelper::getCommentsByContentId($userId,'Business Canvas', $viewedTeam['team_business_canvas_id']);
    return A::merge($platform,
    [ 
        'viewedTeam'=>$viewedTeam, 
        'editTeam'=>$editTeam, 
        'phaseCompletion'=>$phaseCompletion, 
        'latestComments'=>$latestComments,
        'latestAppreciations'=>$latestAppreciations,
        'skills'=>$skills,
        'profileAppreciations'=>$profileAppreciations,
        'profileComments'=>$profileComments,
        'challengeAppreciations'=>$challengeAppreciations,
        'challengeComments'=>$challengeComments,
        'contextAppreciations'=>$contextAppreciations,
        'contextComments'=>$contextComments,
        'designAppreciations'=>$designAppreciations,
        'designComments'=>$designComments,
        'measureAppreciations'=>$measureAppreciations,
        'measureComments'=>$measureComments,
        'pitchAppreciations'=>$pitchAppreciations,
        'pitchComments'=>$pitchComments,
    ]);
}
?>