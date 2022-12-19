<?php
include 'helpers/DataHelper.php';

use carefulcollab\helpers as helpers;

return function($kirby, $pages, $page, $site, $requiresLogin =false, $isNonLearningJourneyPage =false) 
{
    if ($requiresLogin&&!$kirby->user())
    {
        $nextPageUrl="";
        if ($nextPage = $page->next())
        {
            $nextPageUrl=$nextPage->url();
        }
        $loginPage=$site->index()->find('login');
        $loginPage->go([ 'query' => [ 'nextPageUrl' => $nextPageUrl, 'currentPageUrl' => $page->url() ]]);
    }
    $userLoggedIn=$kirby->user();
    $userId=1;
    $team=helpers\DataHelper::getTeamByWPUserId($userId);
    $status=$kirby->request()->get('_taskStatus') ? 'task-ok' : '';
    $status=$kirby->request()->get('_commentStatus') ? 'comment-ok' : $status;
    $status=$kirby->request()->get('_appreciationStatus') ? 'appreciation-ok' : $status;

    $pointsAdded=$kirby->request()->get('points') ? $kirby->request()->get('points') : 0;
    $pointsAddedOtherTeam=$kirby->request()->get('pointsOther') ? $kirby->request()->get('pointsOther') : 0;
    $countries=$site->index()->filterBy('template', 'country');

    if (Cookie::exists('country'))
    {
        $country=Cookie::get('country');
        $countryPage=$countries->findBy('title',$country);       
    }
    else
    {
        $language=$kirby->language()->code();    
        $countryPage=$countries->findBy('language', $language);
        
    }
    $country=$countryPage->title();
    $exampleTeam=$countryPage->exampleTeam()->toInt();
    
    if (!$isNonLearningJourneyPage) Cookie::set("resumePage",$_SERVER['REQUEST_URI']);

    $platformPage=site()->find('platform');
    $teamPage=$page->siblings()->find('platform/team-page');
    $otherTeamsPage=$page->siblings()->find('platform/other-teams');
    $commonsPage=$page->siblings()->find('platform/commons');
    $adminPage=$page->siblings()->find('platform/admin');
    $exampleTeamPage=$page->siblings()->find('platform/example-team');
    $loginPage=$page->siblings()->find('platform/login');

    //TODO: switch this to use compact(..)
    return [ 
        'userId' => $userId, 
        'userLoggedIn' => $userLoggedIn, 
        'team' => $team, 'status' =>$status, 
        'userRole' => $team['role'], 
        'pointsAdded' => $pointsAdded, 
        'pointsAddedOtherTeam' =>$pointsAddedOtherTeam, 
        'country'=>$country, 
        'countries'=>$countries, 
        'exampleTeam'=>$exampleTeam,
        'isNonLearningJourneyPage'=>$isNonLearningJourneyPage,
        'platformPage'=>$platformPage,
        'teamPage'=>$teamPage,
        'otherTeamsPage'=>$otherTeamsPage,
        'commonsPage'=>$commonsPage,
        'adminPage'=>$adminPage,
        'exampleTeamPage'=>$exampleTeamPage,
        'loginPage'=>$loginPage,
    ];
}
?>