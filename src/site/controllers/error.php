<?php
return function($kirby, $pages, $page) 
{
    $errorMessage=$kirby->request()->get('errorMessage') ? $kirby->request()->get('errorMessage') : '';
    return [ 'errorMessage' => $errorMessage ];
}
?>