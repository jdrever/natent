<?php

return function($kirby, $pages, $page, $site) 
{
    $platform = $kirby->controller('platform' , compact('page', 'pages', 'kirby'));
    $viewedTeam=$platform['team'];
    $editTeam=true;
    return $kirby->controller('team', compact('platform', 'site', 'viewedTeam', 'editTeam'));

    
};