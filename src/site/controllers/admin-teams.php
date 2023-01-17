<?php

use carefulcollab\helpers as helpers;
use carefulcollab\helpers\DataResult;

return function ($kirby, $pages, $page, $site)
{
  $requiresLogin = true;
  $platform = $kirby->controller('platform', compact('page', 'pages', 'kirby', 'site', 'requiresLogin'));
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
          'password'  => get('password'),
          'language'  => 'en',
          'role'      => 'team',
          'content'   => [
            'birthdate' => '1989-01-29'
          ]
        ]);


        //TODO: absolutely can't hard code this
        $locationId = 2;
        $result = helpers\DataHelper::addTeam($userId, $teamName, $locationId);
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
        $team=$kirby->user(str_replace(' ', '-', $oldTeamName) . '@natent.eu');
        $result = helpers\DataHelper::updateTeamName($userId, $teamId, $teamName);
        $team->changeName($teamName);
        $team->changeEmail(str_replace(' ', '-', $teamName) . '@natent.eu');
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
        $team=$kirby->user(str_replace(' ', '-', $teamName) . '@natent.eu');
        $team->changePassword($password);
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
        $team=$kirby->user(str_replace(' ', '-', $teamName) . '@natent.eu');
        $team->delete();
      }
      catch (Exception $e)
      {

        $result->errorMessage='The team could not be removed: '.$e->getMessage();
        $result->wasSuccessful = false;
      }
    }
  }

  $teams = helpers\DataHelper::getTeamsByLocation($userId);
  return A::merge($platform, compact( 'teams','newPassword', 'result', 'actionType', 'selectedTab'));
};
