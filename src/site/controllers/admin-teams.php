<?php
use carefulcollab\helpers as helpers;

return function($kirby, $pages, $page, $site) {
    $requiresLogin = true;
    $platform = $kirby->controller('platform' , compact('page', 'pages', 'kirby', 'site', 'requiresLogin'));
    $team = $platform['team'];
    $country = $platform['country'];
    
    if($kirby->request()->is('POST')) 
    {
        try {

            $user = $kirby->users()->create([
              'name'      => get('team'),
              'email'     => get('team').'@natent.eu',
              'password'  => get('password'),
              'language'  => 'en',
              'role'      => 'editor',
              'content'   => [
                'birthdate' => '1989-01-29'
              ]
            ]);
          
            echo 'The user "' . $user->name() . '" has been created';
            $result=true;
          
          } catch(Exception $e) {
          
            echo 'The user could not be created';
            $result=false;
            echo($e->getMessage());
          
          }

          return A::merge($platform, compact('result'));
    }
    else
    {
        return A::merge($platform, [
            'showForm' => true
        ]);
    }
};