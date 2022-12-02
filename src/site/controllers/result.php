<?php
return function($page, $site,  $result) 
{
    if ($result->wasSuccessful)
    {
        $pointsToAdd = 20;
        if ($nextPage = $page->next())
        {
            $nextPage->go(['query' => ['_taskStatus' => 'ok', 'points' =>$pointsToAdd ]]);
        }
        $page->go(['query' => ['_taskStatus' => 'ok', 'points' =>$pointsToAdd ]]);
    }
    else
    {
        //return $platform;
        if ($page=$site->find('error'))
            $page->go([ 'query' => ['errorMessage' => isset($result->errorMessage) ? $result->errorMessage : 'No error message returned']]);
    }
}
?>