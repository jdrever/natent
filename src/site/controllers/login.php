<?php

return function ($kirby, $page, $pages, $site) {

  // don't show the login screen to already logged in users
  if ($kirby->user()) {
    go('/');
  }

  $requiresLogin = false;
  $isNonLearningJourneyPage = true;
  $platform = $kirby->controller('platform', compact('kirby', 'pages', 'page', 'site', 'requiresLogin', 'isNonLearningJourneyPage'));

  $error = false;
  $alert="";

  // handle the form submission
  if ($kirby->request()->is('POST') && get('login')) {

    // try to log the user in with the provided credentials
    try {
      $login=get('login');
      if (strpos($login,'@')===0)$login.='@natent.eu';
      $login=str_replace(' ','-',$login);
      echo($login);
      $kirby->auth()->login($login, get('password'));


      // redirect to the homepage if the login was successful

      if (get('currentPageUrl')) 
      {
        go(get('currentPageUrl'));
      }
      else
      {
        go('/platform');
      }
    } catch (Exception $e) {
      $error = true;
      $alert="This login could not be recognised";
      echo($e);
    }

  }
  return A::merge($platform,[
    'error' => $error,
    'alert' => $alert,
    'nextPageUrl' => get('nextPageUrl'),
    'userLoggedIn' => false,
    'isNonLearningJourneyPage' =>true,
  ]);

};