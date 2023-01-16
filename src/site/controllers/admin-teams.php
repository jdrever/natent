<?php

use carefulcollab\helpers as helpers;

return function ($kirby, $pages, $page, $site)
{
  $requiresLogin = true;
  $platform = $kirby->controller('platform', compact('page', 'pages', 'kirby', 'site', 'requiresLogin'));
  $team = $platform['team'];
  $userId = $team['user_id'];
  $result = '';

  $country = $platform['country'];

  $newPassword = helpers\DataHelper::random_str(8);

  if ($kirby->request()->is('POST'))
  {
    $action = $_POST['action'];

    if ($action === 'CREATE-TEAM')
    {
      try
      {
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

        //echo 'The user "' . $user->name() . '" has been created';
        $result = true;
      }
      catch (Exception $e)
      {

        echo 'The team could not be created';
        $result = false;
        echo ($e->getMessage());
      }
    }
    if ($action == "RENAME-TEAM")
    {
      $actionType = "Team name update";
      $teamId = $_POST['teamId'];
      $teamName = $_POST['teamName'];
      $oldTeamName = $_POST['teamName'];
      $team=$kirby->user(str_replace(' ', '-', $oldTeamName) . '@natent.eu');
      $result = helpers\DataHelper::updateTeamName($userId, $teamId, $teamName);
      $team->changeName($teamName);
      $team->changeEmail(str_replace(' ', '-', $teamName) . '@natent.eu');
    }

    if ($action == "RESET-PASSWORD")
    {
      $actionType = "Reset team password";
      $teamName = $_POST['teamName'];
      $password = $_POST['password'];
      $team=$kirby->user(str_replace(' ', '-', $teamName) . '@natent.eu');
      $team->changePassword($password);
    }

    if ($action == "REMOVE-TEAM")
    {
      $actionType = "Team removal";
      $teamId = $_POST['teamId'];
      $teamName = $_POST['teamName'];
      $result = helpers\DataHelper::removeTeam($userId, $teamId);
      $team=$kirby->user(str_replace(' ', '-', $teamName) . '@natent.eu');
      $team->delete();
    }
  }

  $teams = helpers\DataHelper::getTeamsByLocation($userId);
  return A::merge($platform, compact('newPassword', 'result', 'teams'));
};
