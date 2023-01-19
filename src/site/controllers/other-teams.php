<?php
use carefulcollab\helpers as helpers;
return function($kirby, $pages, $page, $site) 
{
    $requiresLogin=true;
    $isNonLearningJourneyPage=true;
    $platform = $kirby->controller('platform' , compact('kirby', 'pages', 'page', 'site', 'requiresLogin', 'isNonLearningJourneyPage'));
    $team=$platform['team'];
    $userId=$team['user_id'];

    $countryFilter= $_COOKIE["NETeamsCountry"] ?? "All";
    if (isset($_GET['countryId'])) 
    { 
        $countryFilter=$_GET['countryId'];
        setcookie("NETeamsCountry", $countryFilter);
    }
    
    if ($countryFilter==="All")
        $showAsOutlineAllCountries="";
    else 
        $showAsOutlineAllCountries="outline-";
    
    $skillsetFilter=$_COOKIE["NETeamsSkillset"] ?? "All";
    if (isset($_GET['skillsetName'])) 
    { 
        $skillsetFilter=$_GET['skillsetName'];
        setcookie("NETeamsSkillset", $skillsetFilter);
    }
    
    if ($skillsetFilter==="All")
        $showAsOutlineAllSkillsets="";
    else 
        $showAsOutlineAllSkillsets="outline-";
    
    $areaFilter= $_COOKIE["NETeamsArea"] ?? "All";
    if (isset($_GET['areaId'])) 
    { 
        $areaFilter=$_GET['areaId'];
        setcookie("NETeamsArea", $areaFilter);
    }
    
    if ($areaFilter==="All")
        $showAsOutlineAllAreas="";
    else 
        $showAsOutlineAllAreas="outline-";

    $areas=helpers\DataHelper::getAreasWithAvailableChallenges($team['country_id']);
    $countries = helpers\DataHelper::getCountries();
    $skillsets = helpers\DataHelper::getSkillsets();

    $otherTeams = helpers\DataHelper::getTeamsOrderByPoints($areaFilter, $countryFilter, $skillsetFilter);

    $phases=$site->index()->filterBy('template','phase');


    return A::merge($platform, compact('areas',
        'countries','skillsets', 'otherTeams', 
        'showAsOutlineAllAreas', 'areaFilter', 
        'showAsOutlineAllCountries', 'countryFilter',
        'showAsOutlineAllSkillsets', 'skillsetFilter', 'phases'));

    
};