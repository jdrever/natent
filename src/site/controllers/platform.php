<?php
include 'helpers/DataHelper.php';

use carefulcollab\helpers as helpers;

return function($kirby, $pages, $page) 
{
    $userId=1;
    $team=helpers\DataHelper::getTeamByWPUserId($userId);
    $status=$kirby->request()->get('_taskStatus') ? 'task-ok' : '';
    $status=$kirby->request()->get('_commentStatus') ? 'comment-ok' : $status;
    $status=$kirby->request()->get('_appreciationStatus') ? 'appreciation-ok' : $status;

    return [ 'userId' => $userId, 'team' => $team, 'status' =>$status, 'userRole' => $team['role'] ];
}
?>