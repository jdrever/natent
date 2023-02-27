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
    if (get('_taskStatus')&&get('_taskStatus')=='ok') $status='task-ok' ;
    if (get('_taskStatus')&&get('_taskStatus')=='error') $status='task-error' ;
    if (get('_recommendStatus')&&get('_recommendStatus')=='ok') $status='recommend-ok' ;
    if (get('_recommendStatus')&&get('_recommendStatus')=='error') $status='recommend-error' ;
    if (get('_taskCommonsStatus')&&get('_taskCommonsStatus')=='ok') $status='task-commons-ok';
    if (get('_taskCommonsStatus')&&get('_taskCommonsStatus')=='error') $status='task-commons-error';
    if (get('_commentStatus')&&get('_commentStatus')=='ok') $status='comment-ok';
    if (get('_commentStatus')&&get('_commentStatus')=='error') $status='comment-error';
    if (get('_appreciationStatus')&&get('_appreciationStatus')=='ok') $status='appreciation-ok';
    if (get('_appreciationStatus')&&get('_appreciationStatus')=='error') $status='appreciation-error';


    $errorMessage=get('message') ? get('message') : '';

    $pointsAdded=$kirby->request()->get('points') ? $kirby->request()->get('points') : 0;
    $pointsAddedOtherTeam=$kirby->request()->get('pointsOther') ? $kirby->request()->get('pointsOther') : 0;
    $maximumPoints=$kirby->request()->get('maxPoints') ? $kirby->request()->get('maxPoints') : 0;
    
    
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
        if ($userLoggedIn)
        {
            $phaseCompletionInfo=helpers\DataHelper::getCompletionByPhaseTypeForTeam($team['id'],$phaseType);
            $phaseCompletion = $phaseCompletionInfo['percent_complete'];
        }
        else
            $phaseCompletion=0;

        $phaseTypePage=$site->find($phaseType);
        $phaseBackground=$phaseTypePage->backgroundColour()->isNotEmpty() ? $phaseTypePage->backgroundColour() : '#ffffff';
        $phaseNumber=$phaseTypePage->phaseNumber();
        $phaseName=$phasePage->title();
    }

    //TODO: switch this to use compact(..)
    return [ 
        'userId' => $userId, 
        'userLoggedIn' => $userLoggedIn, 
        'team' => $team, 
        'status' =>$status, 
        'errorMessage' =>$errorMessage, 
        'userRole' => $userRole, 
        'pointsAdded' => $pointsAdded, 
        'maximumPoints' => $maximumPoints, 
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