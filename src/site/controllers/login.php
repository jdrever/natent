<?php

return function ($kirby) {

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
      echo(var_dump($e));
      die();
    }

  }

  return [
    'error' => $error,
    'nextPageUrl' => get('nextPageUrl'),
    'userLoggedIn' => false
  ];

};