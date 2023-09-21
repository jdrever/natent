<?php

use carefulcollab\helpers as helpers;

return function ($kirby, $pages, $page, $site)
{
    $requiresLogin = false;
    $isNonLearningJourneyPage = true;
    $platform = $kirby->controller('platform', compact('kirby', 'pages', 'page', 'site', 'requiresLogin', 'isNonLearningJourneyPage'));
    $userId = $platform['userId'];
    $latestAppreciations=[];
    $latestComments=[];
    $userLoggedOn=$platform['userLoggedIn'];

    if ($userLoggedOn)
    {
        $latestComments = helpers\DataHelper::getLatestComments($userId);
        $latestAppreciations = helpers\DataHelper::getLatestAppreciations($userId);
    }
    $phases = $site->index()->filterBy('template', 'phase');
    $languagePhases=[];
    $team=$platform['team'];
    $phaseNumber=0;
  
    $languagePage=$platform['languagePage'];

    foreach ($phases as $phase)
    {

        $phasePage = $languagePage->index()->filterBy('phase', strtolower($phase->title()))->first();
        if ($phasePage)
        {
            
            
            $addPhase=new StdClass;
            $addPhase->phaseNumber=$phaseNumber+1;

            if ($userLoggedOn)
            {
                $phaseCompletionInfo = helpers\DataHelper::getCompletionByPhaseTypeForTeam($team['id'], $phase->title());
                $addPhase->phaseCompletion=$phaseCompletionInfo['percent_complete'];
            }
            else
            {
                $addPhase->phaseCompletion=0;
            }
            $addPhase->title=$phasePage->title();
            $addPhase->url=$phasePage->url();
            $addPhase->backgroundColour=$phase->backgroundColour();
            $languagePhases[]=$addPhase;
            $phaseNumber++;
        }
    }

    return A::merge($platform, compact('languagePhases', 'latestComments', 'latestAppreciations'));
};
