<?php

use carefulcollab\helpers as helpers;

return function ($kirby, $pages, $page, $site)
{
    $requiresLogin = false;
    $isNonLearningJourneyPage = true;
    $platform = $kirby->controller('platform', compact('kirby', 'pages', 'page', 'site', 'requiresLogin', 'isNonLearningJourneyPage'));
    $userId = $platform['userId'];
    
    $latestComments = helpers\DataHelper::getLatestComments($userId);
    $latestAppreciations = helpers\DataHelper::getLatestAppreciations($userId);

    $phases = $site->index()->filterBy('template', 'phase');
    $countryPhases=[];
    $country=$platform['country'];
    $team=$platform['team'];
    $phaseNumber=0;

    $language=$kirby->language()->code();  


    $languagePage=$page->children()->filterBy('template','country')->filterBy('language','*=', $language)->first();

    //echo(var_dump($languagePage));

    foreach ($phases as $phase)
    {

        $phasePage = $languagePage->index()->filterBy('phase', strtolower($phase->title()))->first();
        //echo(var_dump($phasePage));
        if ($phasePage)
        {
            //$countryPhase = $pagesInPhase->filterBy('countries', '*=', str_replace(" ", "-", strtolower($country)))->first();
            //if ($countryPhase)
            //{
                $phaseCompletionInfo = helpers\DataHelper::getCompletionByPhaseTypeForTeam($team['id'], $phase->title());
                $addPhase=new StdClass;
                $addPhase->phaseNumber=$phaseNumber+1;
                $addPhase->phaseCompletion=$phaseCompletionInfo['percent_complete'];
                $addPhase->title=$phasePage->title();
                $addPhase->url=$phasePage->url();
                $addPhase->backgroundColour=$phase->backgroundColour();
                $countryPhases[]=$addPhase;
                $phaseNumber++;
            //}
        }
    }

    //echo(var_dump($countryPhases));

    return A::merge($platform, compact('countryPhases', 'latestComments', 'latestAppreciations'));
};
