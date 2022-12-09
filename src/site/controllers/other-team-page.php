<?php
use carefulcollab\helpers as helpers;
return function($kirby, $pages, $page, $site) 
{
    $platform = $kirby->controller('platform' , compact('page', 'pages', 'kirby', 'site'));
    if (get('teamId'))
    {
        $viewedTeam = helpers\DataHelper::getTeamByTeamId(get('teamId'));
        $editTeam=false;        
    }
    return $kirby->controller('team', compact('platform', 'site', 'viewedTeam', 'editTeam'));

    
};