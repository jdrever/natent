<?php
return function($page, $site,  $result, $country) 
{
    if ($result->wasSuccessful)
    {
        $collection=$site->find('platform')->index()->filterBy('template','!=','guide-section-header')->filter(function ($p) use ($country)
        {
            return (($p->template()!='guide')||($p->template()=='guide'&&(str_contains($p->countries(),strtolower($country)))));
        });

        if ($next = $page->children($collection)->filterBy('template','!=','guide-section-header')->first())
        {
            $next->go(['query' => ['_taskStatus' => 'ok', 'points' =>$result->pointsAdded ]]);
        }
        else if ($next = $page->next($collection)) 
        {
            $next->go(['query' => ['_taskStatus' => 'ok', 'points' =>$result->pointsAdded ]] );
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