<?php
return function($page, $site,  $result) 
{
    if ($result->wasSuccessful)
    {
        if ($nextPage = $page->next())
        {
            $nextPage->go(['query' => ['_taskStatus' => 'ok', 'points' =>$result->pointsAdded ]]);
        }
        $page->go(['query' => ['_taskStatus' => 'ok', 'points' =>$result->pointsAdded ]]);
    }
    else
    {
        //return $platform;
        if ($page=$site->find('error'))
            $page->go([ 'query' => ['errorMessage' => isset($result->errorMessage) ? $result->errorMessage : 'No error message returned']]);
    }
}
?>