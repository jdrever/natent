<?php
include 'helpers/DataHelper.php';

use carefulcollab\helpers as helpers;

return function($kirby, $pages, $page) 
{
    $userId=1;
    $team=helpers\DataHelper::getTeamByWPUserId($userId);
    $status=$kirby->request()->get('status') ? $kirby->request()->get('status') : '';
    return [ 'userId' => $userId, 'team' => $team, 'status' =>$status ];
}
?>