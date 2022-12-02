<?php
use carefulcollab\helpers as helpers;
return function($kirby, $pages, $page, $site) 
{
    $platform = $kirby->controller('platform' , compact('page', 'pages', 'kirby'));
    if (get('teamId'))
    {
        $viewedTeam = helpers\DataHelper::getTeamByTeamId(get('teamId'));
        $editTeam=false;        
    }
    return $kirby->controller('team', compact('platform', 'viewedTeam', 'editTeam'));

    
};