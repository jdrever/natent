<?php

return function ($kirby, $page, $site) {

  // don't show the login screen to already logged in users
  if ($kirby->user()) {
    go('/');
  }

  $error = false;

  // handle the form submission
  if ($kirby->request()->is('POST') && get('login')) {

    // try to log the user in with the provided credentials
    try {
      $kirby->auth()->login(get('login'), get('password'));


      // redirect to the homepage if the login was successful

      if (get('currentPageUrl')) 
      {
        go(get('currentPageUrl'));
      }
      else
      {
        go('/');
      }
    } catch (Exception $e) {
      $error = true;
    }

  }
  $platformPage=site()->find('platform');
  $exampleTeamPage=$page->siblings()->find('platform/example-team');
  $loginPage=$page->siblings()->find('platform/login');

  return [
    'error' => $error,
    'nextPageUrl' => get('nextPageUrl'),
    'userLoggedIn' => false,
    'isNonLearningJourneyPage' =>true,
    'platformPage'=>$platformPage,
    'exampleTeamPage'=>$exampleTeamPage,
    'loginPage'=>$loginPage,
  ];

};