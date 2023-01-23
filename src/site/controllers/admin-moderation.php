<?php

use carefulcollab\helpers as helpers;
use carefulcollab\helpers\DataResult;

return function ($kirby, $pages, $page, $site)
{
  $requiresLogin = true;
  $isNonLearningJourneyPage=true;
  $platform = $kirby->controller('platform', compact('page', 'pages', 'kirby', 'site', 'requiresLogin'));
  $team = $platform['team'];
  $userId = $team['user_id'];
  $result = new DataResult();
  $actionType = '';

  if ($team['role'] == 'ADMIN')
    $adminCountry = $team['country_id'];

  if ($team['role'] == 'GLOBAL')
    $adminCountry = Cookie::exists('adminCountry') ? Cookie::get('adminCountry') : 0;

  if ($team['role'] == 'GLOBAL' || $team['role'] == 'ADMIN')
    $adminLocation = Cookie::exists('adminLocation') ? Cookie::get('adminLocation') : 0;

  if ($team['role'] == 'TEACHER')
  {
    $adminLocation = $team['location_id'];
  }
  else
  {
    $locations = ($adminCountry > 0) ? helpers\DataHelper::getLocationsByCountryId($adminCountry) : [];
  }


  if ($kirby->request()->is('POST'))
  {
    $action = $_POST['action'];
    if ($action == "APPROVE" || $action == "REJECT")
    {
      $contentType = $_POST['contentType'];
      $contentId = $_POST['contentId'];
      $selectedTab = 2;

      if ($action == "APPROVE")
      {
        $actionType = "approval of this content";
        $result = helpers\DataHelper::approveContent($userId, $contentType, $contentId);
      }
      if ($action == "REJECT")
      {
        $actionType = "rejection of this content";
        $result = helpers\DataHelper::rejectContent($userId, $contentType, $contentId);
      }
    }
    if ($action == "APPROVE-ALL")
    {
      $actionType = "approval of this content";
      $result = helpers\DataHelper::approveAllContent($userId, $adminLocation);
    }
  }

  $countries = helpers\DataHelper::getCountries();



  $items = helpers\DataHelper::getModerationQueue($adminLocation);
  return A::merge($platform, compact('items', 'countries', 'locations', 'adminCountry', 'adminLocation', 'result', 'actionType'));
};
