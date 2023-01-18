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

    if ($action === 'CREATE-TEACHER')
    {
      try
      {
        $actionType='creation of the teacher';
        $teacherName = $_POST['teacherName'];


        $user = $kirby->users()->create([
          'name'      => $teacherName,
          'email'     => str_replace(' ', '-', $teacherName) . '@natent.eu',
          'password'  => get('password'),
          'language'  => 'en',
          'role'      => 'teacher',
        ]);

        $locationId = $_POST['locationId'];
        $result = helpers\DataHelper::addTeamandUser($userId, $user->id(), $teacherName, $locationId, 'TEACHER');
      }
      catch (Exception $e)
      {

        $result->errorMessage='The teacher could not be added: '.$e->getMessage();
        $result->wasSuccessful = false;
      }
    }
    if ($action == "RENAME-TEACHER")
    {
      $selectedTab='edit';
      try
      {
        $actionType = "teacher name update";
        $teacherId = $_POST['teacherId'];
        $teacherName = $_POST['teacherName'];
        $oldTeacherName = $_POST['oldTeacherName'];
        $renameTeacher=$kirby->user(str_replace(' ', '-', $oldTeacherName) . '@natent.eu');
        $result = helpers\DataHelper::updateTeamName($userId, $teacherId, $teacherName);
        $renameTeacher->changeName($teacherName);
        $renameTeacher->changeEmail(str_replace(' ', '-', $teacherName) . '@natent.eu');
      }
      catch (Exception $e)
      {

        $result->errorMessage='The teacher could not be renamed: '.$e->getMessage();
        $result->wasSuccessful = false;
      }
    }

    if ($action == "RESET-PASSWORD")
    {
      $selectedTab='edit';
      try
      {

        $actionType = "Reset teacher password";
        $teamName = $_POST['teacherName'];
        $password = $_POST['password'];
        $resetTeam=$kirby->user(str_replace(' ', '-', $teamName) . '@natent.eu');
        $resetTeam->changePassword($password);
      }
      catch (Exception $e)
      {

        $result->errorMessage='The password could not be reset: '.$e->getMessage();
        $result->wasSuccessful = false;
      }
    }

    if ($action == "REMOVE-TEACHER")
    {
      $selectedTab='edit';
      try
      {
        $actionType = "Teacher removal";
        $teamId = $_POST['teacherId'];
        $teamName = $_POST['teacherName'];
        $result = helpers\DataHelper::removeTeam($userId, $teamId);
        $removeTeam=$kirby->user(str_replace(' ', '-', $teamName) . '@natent.eu');
        $removeTeam->delete();
      }
      catch (Exception $e)
      {

        $result->errorMessage='The teacher could not be removed: '.$e->getMessage();
        $result->wasSuccessful = false;
      }
    }
  }
  $countries = helpers\DataHelper::getCountries();
  $adminCountry=0;
  $adminLocation=0;

  if ($team['role']=='ADMIN')
  {
    $adminCountry=$team['country_id'];
  }
  if ($team['role']=='GLOBAL')
    $adminCountry=Cookie::exists('adminCountry') ? Cookie::get('adminCountry') : 0;
  
  if ($team['role']=='GLOBAL'||$team['role']=='ADMIN')
    $adminLocation=Cookie::exists('adminCountry') ? Cookie::get('adminLocation') : 0;

  $locations=($adminCountry>0) ? helpers\DataHelper::getLocationsByCountryId($adminCountry) : [];
  $teachers = helpers\DataHelper::getTeachersByLocationId($adminLocation);

  
  return A::merge($platform, compact( 'teachers','countries','locations','newPassword', 'result', 'actionType', 'selectedTab', 'adminCountry','adminLocation'));
};
