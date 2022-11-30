<?php
return function($page, $site,  $result) 
{
    if ($result->wasSuccessful)
    {
        $pointsToAdd = 20;
        if ($nextPage = $page->next())
        {
            $nextPage->go(['query' => ['status' => 'ok', 'points' =>$pointsToAdd ]]);
        }
        $page->go(['query' => ['status' => 'ok', 'points' =>$pointsToAdd ]]);
    }
    else
    {
        //return $platform;
        if ($page=$site->find('error'))
            $page->go([ 'query' => ['errorMessage' => isset($result->errorMessage) ? $result->errorMessage : 'No error message returned']]);
    }
}
?>