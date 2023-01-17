<?php

use carefulcollab\helpers as helpers;

return function ($kirby, $pages, $page, $site)
{
  $requiresLogin = true;
  $platform = $kirby->controller('platform', compact('page', 'pages', 'kirby', 'site', 'requiresLogin'));
  $team = $platform['team'];
  $userId = $team['user_id'];
  $result = '';
  $actionType='';

  $country = $platform['country'];

  if ($kirby->request()->is('POST'))
  {
    $action = $_POST['action'];

    if ($action=="ADD-NEW-LOCATION")
    {
        $actionType="adding of a new Location";
        $locationName=$_POST['locationName'];
        $locationLatitude=$_POST['locationLatitude'];
        $locationLongitude=$_POST['locationLongitude'];
        $countryId=$_POST['countryId'];
        $result=helpers\DataHelper::addLocation($userId, $countryId, $locationName, $locationLatitude, $locationLongitude);
        $selectedTab=4;
    }

    if ($action=="UPDATE-LOCATION")
    {
        $actionType="updating of a Location";
        $locationId=$_POST['locationId'];
        $locationName=$_POST['locationName'];
        $locationLatitude=$_POST['locationLatitude'];
        $locationLongitude=$_POST['locationLongitude'];
        $result=helpers\DataHelper::updateLocation($userId, $locationId, $locationName, $locationLatitude, $locationLongitude);
        $selectedTab=4;
    }

    if ($action=="REMOVE-LOCATION")
    {
        $actionType="removal of a Location";
        $locationId=$_POST['locationId'];
        $result=helpers\DataHelper::removeLocation($userId, $locationId);
        $selectedTab=4;
    }
  }

  $countries = helpers\DataHelper::getCountries();
  $locations = helpers\DataHelper::getLocationsByCountry($userId);
  return A::merge($platform, compact('countries', 'locations','result', 'actionType'));
};
