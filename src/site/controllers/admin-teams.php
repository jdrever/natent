<?php

use carefulcollab\helpers as helpers;
use carefulcollab\helpers\DataResult;

return function ($kirby, $pages, $page, $site)
{
  $requiresLogin = true;
  $isNonLearningJourneyPage =false;
  $requiresAdminRole=true;
  $platform = $kirby->controller('platform', compact('page', 'pages', 'kirby', 'site', 'requiresLogin', 'isNonLearningJourneyPage','requiresAdminRole'));
  $team = $platform['team'];
  $userId = $team['user_id'];
  $result = new DataResult();
  $actionType='';
  $selectedTab='add';

  $country = $platform['country'];

  $newPassword = helpers\DataHelper::random_str(8);

  if ($kirby->request()->is('POST'))
  {
    $action = $_POST['action'];

    if ($action === 'CREATE-TEAM')
    {
      try
      {
        $actionType='creation of the team';
        $teamName = $_POST['teamName'];


        $user = $kirby->users()->create([
          'name'      => $teamName,
          'email'     => str_replace(' ', '-', $teamName) . '@natent.eu',
          'password'  => get('teamPassword'),
          'language'  => 'en',
          'role'      => 'team',
        ]);

        $locationId = $_POST['locationId'];

        $result = helpers\DataHelper::addTeamandUser($userId, $user->id(), $teamName, $locationId, 'STUDENT');
      }
      catch (Exception $e)
      {

        $result->errorMessage='The team could not be created: '.$e->getMessage();
        $result->wasSuccessful = false;
      }
    }
    if ($action == "RENAME-TEAM")
    {
      $selectedTab='edit';
      try
      {
        $actionType = "team name update";
        $teamId = $_POST['teamId'];
        $teamName = $_POST['teamName'];
        $oldTeamName = $_POST['oldTeamName'];
        $renameTeam=$kirby->user(str_replace(' ', '-', $oldTeamName) . '@natent.eu');
        $result = helpers\DataHelper::updateTeamName($userId, $teamId, $teamName);
        $renameTeam->changeName($teamName);
        $renameTeam->changeEmail(str_replace(' ', '-', $teamName) . '@natent.eu');
        $result->wasSuccessful = true;
      }
      catch (Exception $e)
      {

        $result->errorMessage='The team could not be renamed: '.$e->getMessage();
        $result->wasSuccessful = false;
      }
    }

    if ($action == "RESET-PASSWORD")
    {
      $selectedTab='edit';
      try
      {

        $actionType = "Reset team password";
        $teamName = $_POST['teamName'];
        $password = $_POST['password'];
        $resetTeam=$kirby->user(str_replace(' ', '-', $teamName) . '@natent.eu');
        $resetTeam->changePassword($password);
        $result->wasSuccessful = true;
      }
      catch (Exception $e)
      {

        $result->errorMessage='The password could not be reset: '.$e->getMessage();
        $result->wasSuccessful = false;
      }
    }

    if ($action == "REMOVE-TEAM")
    {
      $selectedTab='edit';
      try
      {
        $actionType = "Team removal";
        $teamId = $_POST['teamId'];
        $teamName = $_POST['teamName'];
        $result = helpers\DataHelper::removeTeam($userId, $teamId);
        $removeTeam=$kirby->user(str_replace(' ', '-', $teamName) . '@natent.eu');
        $removeTeam->delete();
        $result->wasSuccessful = true;
      }
      catch (Exception $e)
      {

        $result->errorMessage='The team could not be removed: '.$e->getMessage();
        $result->wasSuccessful = false;
      }
    }
  }
  $countries = helpers\DataHelper::getCountries();
  $adminCountry=0;
  $adminLocation=0;

  if ($team['role']=='ADMIN')
    $adminCountry=$team['country_id'];
    
  if ($team['role']=='GLOBAL')
    $adminCountry=Cookie::exists('adminCountry') ? Cookie::get('adminCountry') : 0;
  
  if ($team['role']=='GLOBAL'||$team['role']=='ADMIN')
    $adminLocation=Cookie::exists('adminCountry') ? Cookie::get('adminLocation') : 0;


  if ($team['role']=='TEACHER')
  {
    $locations=helpers\DataHelper::getLocationsByCountry($userId);
    $teams = helpers\DataHelper::getTeamsByLocation($userId);
    $adminLocation=$team['location_id'];
  }
  else
  {
    $locations=($adminCountry>0) ? helpers\DataHelper::getLocationsByCountryId($adminCountry) : [];
    $teams = helpers\DataHelper::getTeamsByLocationId($adminLocation);
  }


  
  return A::merge($platform, compact( 'teams','countries','locations','newPassword', 'result', 'actionType', 'selectedTab', 'adminCountry','adminLocation'));
};
