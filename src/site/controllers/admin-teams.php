<?php
use carefulcollab\helpers as helpers;

return function($kirby, $pages, $page, $site) {
    $requiresLogin = true;
    $platform = $kirby->controller('platform' , compact('page', 'pages', 'kirby', 'site', 'requiresLogin'));
    $team = $platform['team'];
    $country = $platform['country'];

    $newPassword=random_str(8);
    
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

          return A::merge($platform, compact('newPassword','result'));
    }
    else
    {
        return A::merge($platform, compact('newPassword'));
    }
};

/**
 * Generate a random string, using a cryptographically secure 
 * pseudorandom number generator (random_int)
 *
 * This function uses type hints now (PHP 7+ only), but it was originally
 * written for PHP 5 as well.
 * 
 * For PHP 7, random_int is a PHP core function
 * For PHP 5.x, depends on https://github.com/paragonie/random_compat
 * 
 * @param int $length      How many characters do we want?
 * @param string $keyspace A string of all possible characters
 *                         to select from
 * @return string
 */
function random_str(
  int $length = 64,
  string $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
): string {
  if ($length < 1) {
      throw new \RangeException("Length must be a positive integer");
  }
  $pieces = [];
  $max = mb_strlen($keyspace, '8bit') - 1;
  for ($i = 0; $i < $length; ++$i) {
      $pieces []= $keyspace[random_int(0, $max)];
  }
  return implode('', $pieces);
}