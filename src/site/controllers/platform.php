<?php
include 'helpers/DataHelper.php';

use carefulcollab\helpers as helpers;

return function($kirby, $pages, $page, $site, $requiresLogin =false, $isNonLearningJourneyPage =false, $requiresAdminRole=false) 
{
    $loginPage=$site->index()->find('platform/login');
    if ($requiresLogin&&!$kirby->user())
    {
        $nextPageUrl="";
        if ($nextPage = $page->next())
        {
            $nextPageUrl=$nextPage->url();
        }

        $loginPage->go([ 'query' => [ 'nextPageUrl' => $nextPageUrl, 'currentPageUrl' => $page->url() ]]);
    }

    $userId=0;
    $team=[];
    $userRole='';
    $userLoggedIn=$kirby->user();



    if ($userLoggedIn)
    {
        $kirbyUserId=$userLoggedIn->id();
        $team=helpers\DataHelper::getTeamByKirbyUserId($kirbyUserId);
        $userId=$team['user_id'];
        $userRole=$team['role'];
    }

    if ($requiresAdminRole&&(!in_array($userRole,array('TEACHER','ADMIN','GLOBAL'))))
        $loginPage->go();

    $status='';
    if ($kirby->request()->get('_taskStatus')) $status='task-ok' ;
    if ($kirby->request()->get('_taskCommonsStatus')) $status=$kirby->request()->get('task-commons-ok') ;
    if ($kirby->request()->get('_commentStatus')) $status=$kirby->request()->get('comment-ok') ;
    if ($kirby->request()->get('_appreciationStatus')) $status=$kirby->request()->get('appreciation-ok') ;

    $pointsAdded=$kirby->request()->get('points') ? $kirby->request()->get('points') : 0;
    $pointsAddedOtherTeam=$kirby->request()->get('pointsOther') ? $kirby->request()->get('pointsOther') : 0;
    
    
    if (!$isNonLearningJourneyPage) Cookie::set("resumePage",$_SERVER['REQUEST_URI']);

    $platformPage=site()->find('platform');

    $countries=$site->index()->filterBy('template', 'country');
    $language=$kirby->language()->code();
    $languagePage=$platformPage->children()->filterBy('template','country')->filterBy('language','*=', $language)->first();

    if (is_null($languagePage)) $languagePage=$platformPage->children()->filterBy('template','country')->filterBy('language','*=', 'en')->first();

    $country=$languagePage->title();
    $exampleTeam=$languagePage->exampleTeam()->toInt();

    $teamPage=$platformPage->children()->find('platform/team-page');
    $otherTeamsPage=$platformPage->children()->find('platform/other-teams');
    $resourcesPage=$platformPage->children()->find('platform/resources');
    $commonsPage=$resourcesPage->children()->find('commons');
    $nupsPage=$resourcesPage->children()->find('nups');
    $glossaryPage=$resourcesPage->children()->find('glossary');
    $adminPage=$platformPage->children()->find('platform/admin');
    $exampleTeamPage=$platformPage->children()->find('platform/example-team');
    $loginPage=$platformPage->children()->find('platform/login');
    $switchTeamsPage=$platformPage->index()->find('platform/admin/switch-teams');
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
    $phaseNumber=0;
    $phaseBackground='#ffffff';
    $phaseName='';
    if ($phasePage)
    {
        $phaseType=$phasePage->phase();
        $phaseCompletionInfo=helpers\DataHelper::getCompletionByPhaseTypeForTeam($team['id'],$phaseType);
        $phaseCompletion = $phaseCompletionInfo['percent_complete'];
        $phaseTypePage=$site->find($phaseType);
        $phaseBackground=$phaseTypePage->backgroundColour()->isNotEmpty() ? $phaseTypePage->backgroundColour() : '#ffffff';
        $phaseNumber=$phaseTypePage->phaseNumber();
        $phaseName=$phasePage->title();
    }

    //TODO: switch this to use compact(..)
    return [ 
        'userId' => $userId, 
        'userLoggedIn' => $userLoggedIn, 
        'team' => $team, 'status' =>$status, 
        'userRole' => $userRole, 
        'pointsAdded' => $pointsAdded, 
        'pointsAddedOtherTeam' =>$pointsAddedOtherTeam, 
        'country'=>$country, 
        'countries'=>$countries, 
        'exampleTeam'=>$exampleTeam,
        'isNonLearningJourneyPage'=>$isNonLearningJourneyPage,
        'languagePage' => $languagePage,
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
        'switchTeamsPage'=>$switchTeamsPage,
        'registerPage'=>$registerPage,
        'phaseType' => $phaseType,
        'phaseName'=>$phaseName,
        'phaseCompletion'=>$phaseCompletion,
        'phaseBackground'=>$phaseBackground,
        'phaseNumber'=>$phaseNumber,
    ];
}
?>