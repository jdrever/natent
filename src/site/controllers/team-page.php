<?php
use carefulcollab\helpers as helpers;

return function($kirby, $pages, $page, $site) 
{
    $platform = $kirby->controller('platform' , compact('page', 'pages', 'kirby'));

    $viewedTeam=$platform['team'];
    $phaseCompletion=[];
    $phases = helpers\DataHelper::getPhasesByCountryId($viewedTeam['country_id']);
    $latestComments=helpers\DataHelper::getLatestComments($viewedTeam['user_id']);
    $latestAppreciations=helpers\DataHelper::getLatestAppreciations($viewedTeam['user_id']);

    foreach ($phases as $nextPhase)
    {
        $phase[0] = $nextPhase['phase_title'];
        $phaseCompletionInfo=helpers\DataHelper::getCompletionByPhaseTypeForTeam($viewedTeam['id'],$nextPhase['phase_type']);
        $phase[1] = $phaseCompletionInfo['percent_complete'];
        $phaseCompletion[]=$phase;
    }
    $skills=helpers\DataHelper::getSkillsets();

    $profileAppreciations=helpers\DataHelper::getAppreciationsByContentId($viewedTeam['user_id'],'Team Profile', $viewedTeam['profile_id']);
    $profileComments=helpers\DataHelper::getCommentsByContentId($viewedTeam['user_id'],'Team Profile', $viewedTeam['profile_id']);
    $challengeAppreciations=helpers\DataHelper::getAppreciationsByContentId($viewedTeam['user_id'],'Team Challenge', $viewedTeam['team_challenge_id']);
    $challengeComments=helpers\DataHelper::getCommentsByContentId($viewedTeam['user_id'],'Team Challenge', $viewedTeam['team_challenge_id']);
    $contextAppreciations=helpers\DataHelper::getAppreciationsByContentId($viewedTeam['user_id'],'Challenge Definition', $viewedTeam['team_challenge_definition_id']);
    $contextComments=helpers\DataHelper::getCommentsByContentId($viewedTeam['user_id'],'Challenge Definition', $viewedTeam['team_challenge_definition_id']);
    $designAppreciations=helpers\DataHelper::getAppreciationsByContentId($viewedTeam['user_id'],'Design Idea', $viewedTeam['team_design_idea_id']);
    $designComments=helpers\DataHelper::getCommentsByContentId($viewedTeam['user_id'],'Design Idea', $viewedTeam['team_design_idea_id']);
    $measureAppreciations=helpers\DataHelper::getAppreciationsByContentId($viewedTeam['user_id'],'Measures', $viewedTeam['team_measures_id']);
    $measureComments=helpers\DataHelper::getCommentsByContentId($viewedTeam['user_id'],'Measures', $viewedTeam['team_measures_id']);
    $pitchAppreciations=helpers\DataHelper::getAppreciationsByContentId($viewedTeam['user_id'],'Business Canvas', $viewedTeam['team_business_canvas_id']);
    $pitchComments=helpers\DataHelper::getCommentsByContentId($viewedTeam['user_id'],'Business Canvas', $viewedTeam['team_business_canvas_id']);
    return A::merge($platform,
    [ 
        'viewedTeam'=>$viewedTeam, 
        'editTeam'=>true, 
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
    
};