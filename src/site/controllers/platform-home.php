<?php
use carefulcollab\helpers as helpers;
return function($kirby, $pages, $page, $site) 
{
    $requiresLogin=false;
    $isNonLearningJourneyPage=true;
    $platform = $kirby->controller('platform' , compact('kirby', 'pages', 'page', 'site', 'requiresLogin', 'isNonLearningJourneyPage'));
    $userId=$platform['userId'];
    $phases=$site->index()->filterBy('template','phase');
    $latestComments=helpers\DataHelper::getLatestComments($userId);
    $latestAppreciations=helpers\DataHelper::getLatestAppreciations($userId);

    $teamPage=$page->siblings()->find('team-page');
    $otherTeamsPage=$page->siblings()->find('other-teams');
    $commonsPage=$page->siblings()->find('commons');
    return A::merge($platform,compact('phases','latestComments','latestAppreciations','teamPage','otherTeamsPage', 'commonsPage'));    
};