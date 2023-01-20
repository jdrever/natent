<?php
use carefulcollab\helpers as helpers;
return function($kirby, $pages, $page, $site) 
{
    $requiresLogin=true;
    $isNonLearningJourneyPage=true;
    $platform = $kirby->controller('platform' , compact('kirby', 'pages', 'page', 'site', 'requiresLogin', 'isNonLearningJourneyPage'));
    $team=$platform['team'];
    $userId=$team['user_id'];

    $countryFilter= $_COOKIE["NECommonsCountry"] ?? "All";
    if (isset($_GET['countryId'])) 
    { 
        $countryFilter=$_GET['countryId'];
        setcookie("NECommonsCountry", $countryFilter);
    }

    if ($countryFilter==="All")
        $showAsOutlineAllCountries="";
    else 
        $showAsOutlineAllCountries="outline-";

    $collaborationPointFilter=$_COOKIE["NECommonsPoint"] ?? "All";
    if (isset($_GET['collaborationPointType'])) 
    { 
        $collaborationPointFilter=$_GET['collaborationPointType']; 
        setcookie("NECommonsPoint", $collaborationPointFilter);
    }

    $phaseTypeFilter=$_COOKIE["NECommonsPhase"] ?? "All";
    if (isset($_GET['phaseType'])) 
    { 
        $phaseTypeFilter=$_GET['phaseType'];
        setcookie("NECommonsPhase", $phaseTypeFilter);

        if (isset($_COOKIE["NECommonsPhase"])&&$phaseTypeFilter!=$_COOKIE["NECommonsPhase"])
        {
            $collaborationPointFilter="All";
            setcookie("NECommonsPoint", $collaborationPointFilter);
        }
    }

    if ($phaseTypeFilter==="All")
    {
        $showAsOutlineAllPhases="";
    }
    else 
        $showAsOutlineAllPhases="outline-";

    if ($phaseTypeFilter==="General" or empty($phaseTypeFilter))
    {
        $showAsOutlineGeneralPhase="";
        $phaseTypeFilter="General";
    }
    else 
        $showAsOutlineGeneralPhase="outline-";  

    $recommendedFilter=$_COOKIE["NERecommended"] ?? "All";
    if (isset($_GET['resources'])) 
    { 
        $recommendedFilter=$_GET['resources'];
        setcookie("NERecommended", $recommendedFilter);
    }

    $showRecommendedResourcesAsOutline="outline-";
    $showAllResourcesAsOutline="";

    if ($recommendedFilter==="All")
    {
        $showRecommendedResourcesAsOutline="outline-";
        $showAllResourcesAsOutline="";   
    }
    else
    {
        $showRecommendedResourcesAsOutline="";
        $showAllResourcesAsOutline="outline-";
    }

    //$phases = helpers\DataHelper::getPhasesByCountryId($team['country_id']);

    $phaseTypes=$site->index()->filterBy('template','phase');
    $phases=[];
    

    $languagePage=$platform['languagePage'];
    
    foreach ($phaseTypes as $nextPhase)
    {
        $phasePage = $languagePage->index()->filterBy('phase', strtolower($nextPhase->title()))->first();
        $phases[]=$phasePage;
    }

    //echo(var_dump($phases));
    //die();

    $phaseTypeFilterSet=false;

    $resources = helpers\DataHelper::getResourcesFromCommons($userId,$phaseTypeFilter,$collaborationPointFilter, $countryFilter, $recommendedFilter);





    return A::merge($platform, compact('resources', 'phases','countryFilter', 'showAsOutlineAllCountries', 
        'collaborationPointFilter', 'phaseTypeFilter',
        'phaseTypeFilter', 'showAsOutlineAllPhases', 'showAsOutlineGeneralPhase', 
        'recommendedFilter', 'showRecommendedResourcesAsOutline', 'showAllResourcesAsOutline', 'phaseTypeFilterSet'));

    
};