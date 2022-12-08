<?php

return [
    'debug'  => true,
    'languages' =>true,
    'panel' =>
    [
      'install' => true,
      'css' => 'assets/css/panel.css',
    ],
    'routes' => [
      [
        'pattern' => 'collab-controller',
        'method' => 'POST',
        'action'  => function () {
          return new Page([
            'slug' => 'collab-controller',
            'template' => 'collab-controller',
            'content' => [
              'title' => 'This is not a real page',
              'text'  => 'Believe it or not, this page is not in the file system'
            ]
          ]);
        }
      ],
      [
        'pattern' => 'logout',
        'action'  => function() {
  
          if ($user = kirby()->user()) {
            $user->logout();
          }
  
          go('login');
  
        }
      ]
    ]

];