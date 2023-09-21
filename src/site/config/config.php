<?php
return [
    'debug'  => ($_SERVER['HTTP_HOST']=='localhost:8085' or $_SERVER['HTTP_HOST']=='staging.natent.eu') ? true : true,
    'languages' =>true,
    'auth' => [
      'trials' => 500
    ],
    'panel' =>
    [
      'install' => true,
      'css' => 'assets/css/panel.css',
    ],
    'defaultEmail' => 'james@careful.digital',
    'routes' => [
      [
        'pattern' => 'collab-controller',
        'method' => 'POST',
        'action'  => function () {
          return new Page([
            'slug' => 'collab-controller',
            'template' => 'collab-controller',
          ]);
        }
      ],
      [
        'pattern' => 'admin-controller',
        'method' => 'POST',
        'action'  => function () {
          return new Page([
            'slug' => 'admin-controller',
            'template' => 'admin-controller',
          ]);
        }
      ],
      [
        'pattern' => 'country-controller',
        'method' => 'GET',
        'action'  => function () {
          return new Page([
            'slug' => 'country-controller',
            'template' => 'country-controller',
          ]);
        }
      ],
      [
        'pattern' => 'logout',
        'action'  => function() {
  
          if ($user = kirby()->user()) {
            $user->logout();
          }
  
          go('platform/login');
  
        }
      ]
      ],
      'db' => require_once 'dbconfig.php'
];