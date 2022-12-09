<?php
include 'helpers/DataHelper.php';

use carefulcollab\helpers as helpers;

return function($kirby, $pages, $page, $site) 
{
    $userId=1;
    $team=helpers\DataHelper::getTeamByWPUserId($userId);
    $status=$kirby->request()->get('_taskStatus') ? 'task-ok' : '';
    $status=$kirby->request()->get('_commentStatus') ? 'comment-ok' : $status;
    $status=$kirby->request()->get('_appreciationStatus') ? 'appreciation-ok' : $status;

    $pointsAdded=$kirby->request()->get('points') ? $kirby->request()->get('points') : 0;
    $pointsAddedOtherTeam=$kirby->request()->get('pointsOther') ? $kirby->request()->get('pointsOther') : 0;
    $countries=$site->index()->filterBy('template', 'country');

    if (Cookie::exists('country'))
    {
        $country=Cookie::get('country');
    }
    else
    {
        $language=$kirby->language()->code();    
        $country=$countries->findBy('language', $language)->title();
    }


    return [ 'userId' => $userId, 'team' => $team, 'status' =>$status, 'userRole' => $team['role'], 'pointsAdded' => $pointsAdded, 'pointsAddedOtherTeam' =>$pointsAddedOtherTeam, 'country'=>$country, 'countries'=>$countries ];
}
?>