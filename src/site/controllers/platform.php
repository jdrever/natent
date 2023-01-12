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
        $loginPage=$site->index()->find('platform/login');
        $loginPage->go([ 'query' => [ 'nextPageUrl' => $nextPageUrl, 'currentPageUrl' => $page->url() ]]);
    }
    $countries=$site->index()->filterBy('template', 'country');
    $language=$kirby->language()->code();
    $countryPage=$countries->findBy('language', $language);
    
    $country=$countryPage->title();
    $exampleTeam=$countryPage->exampleTeam()->toInt();

    $userLoggedIn=$kirby->user();
    $userId=1;
    $team=helpers\DataHelper::getTeamByWPUserId($userId);
    $status='';
    if ($kirby->request()->get('_taskStatus')) $status='task-ok' ;
    if ($kirby->request()->get('_taskCommonsStatus')) $status=$kirby->request()->get('task-commons-ok') ;
    if ($kirby->request()->get('_commentStatus')) $status=$kirby->request()->get('comment-ok') ;
    if ($kirby->request()->get('_appreciationStatus')) $status=$kirby->request()->get('appreciation-ok') ;

    $pointsAdded=$kirby->request()->get('points') ? $kirby->request()->get('points') : 0;
    $pointsAddedOtherTeam=$kirby->request()->get('pointsOther') ? $kirby->request()->get('pointsOther') : 0;
    


    
    if (!$isNonLearningJourneyPage) Cookie::set("resumePage",$_SERVER['REQUEST_URI']);

    $platformPage=site()->find('platform');
    $teamPage=$platformPage->children()->find('platform/team-page');
    $otherTeamsPage=$platformPage->children()->find('platform/other-teams');
    $resourcesPage=$platformPage->children()->find('platform/resources');
    $commonsPage=$resourcesPage->children()->find('commons');
    $nupsPage=$resourcesPage->children()->find('nups');
    $glossaryPage=$resourcesPage->children()->find('glossary');
    $adminPage=$platformPage->children()->find('platform/admin');
    $exampleTeamPage=$platformPage->children()->find('platform/example-team');
    $loginPage=$platformPage->children()->find('platform/login');
    $registerPage=site()->find('register-your-school');

    if ($page->template()=='guide')
    {
        $phasePage=$page;
    }
    else
    {
        $phasePage=$page->parents()->filterBy('template','guide')->first();
    }
    $phaseCompletion=0;
    $phaseType='';
    $phaseBackground='#ffffff';
    if ($phasePage)
    {
        $phaseType=$phasePage->phase();
        $phaseCompletionInfo=helpers\DataHelper::getCompletionByPhaseTypeForTeam($team['id'],$phaseType);
        $phaseCompletion = $phaseCompletionInfo['percent_complete'];
        $phaseTypePage=$site->find($phaseType);
        $phaseBackground=$phaseTypePage->backgroundColour()->isNotEmpty() ? $phaseTypePage->backgroundColour() : '#ffffff';
    }

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
        'resourcesPage'=>$resourcesPage,
        'commonsPage'=>$commonsPage,
        'nupsPage'=>$nupsPage,
        'glossaryPage'=>$glossaryPage,
        'adminPage'=>$adminPage,
        'exampleTeamPage'=>$exampleTeamPage,
        'loginPage'=>$loginPage,
        'registerPage'=>$registerPage,
        'phaseType' => $phaseType,
        'phaseCompletion'=>$phaseCompletion,
        'phaseBackground'=>$phaseBackground,
    ];
}
?>