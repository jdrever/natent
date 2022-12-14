<?php
use carefulcollab\helpers as helpers;
return function($kirby, $pages, $page, $site) {
    $requiresLogin = true;
    $platform = $kirby->controller('platform' , compact('page', 'pages', 'kirby', 'site', 'requiresLogin'));
    $team = $platform['team'];
    $country = $platform['country'];
    
    if($kirby->request()->is('POST')) 
    {
        $pitchVideoUrl = str_replace("https://", "", get('pitchVideoUrl')); 
        if ($pitchVideoUrl)
        {
            if (str_starts_with($pitchVideoUrl, "youtu.be/"))
            {
                $pitchVideoYouTubeId = str_replace("youtu.be/", "", $pitchVideoUrl);
            }
            else
            {
                parse_str(parse_url($pitchVideoUrl, PHP_URL_QUERY), $pitchVideoUrlVars);
                $pitchVideoYouTubeId = $pitchVideoUrlVars['v'];
            }
        }
        else
        {
            $pitchVideoYouTubeId = "";
        }

        $result = helpers\DataHelper::updateTeamWithBusinessCanvas($team['user_id'], "", "", "", "", "", $pitchVideoUrl, $pitchVideoYouTubeId);

        return $kirby->controller('result', compact('page', 'site', 'result','country'));
    }
    else
    {
        return A::merge($platform, [
            'showForm' => true
        ]);
    }
};