<?php
use carefulcollab\helpers as helpers;
return function($kirby, $pages, $page, $site) {
    $requiresLogin = false;
    $platform = $kirby->controller('platform' , compact('page', 'pages', 'kirby', 'site', 'requiresLogin'));
    $team = $platform['team'];
    $country = $platform['country'];
    $userLoggedIn=$platform['userLoggedIn'];
    
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

        $userId=$platform['userId'];
        $phaseType=$platform['phaseType'];
        return $kirby->controller('result', compact('page', 'site', 'kirby', 'result','country','userId','phaseType'));
    }
    else
    {

        if ($userLoggedIn)
        {
            $teamArea=$team['area'];
            $teamPitchVideoUrl=$team['pitch_video_url'];
            $teamPitchVideoYouTubeId=$team['pitch_video_you_tube_id'];
        }
        else
        {
            $exampleTeam=helpers\DataHelper::getTeamByTeamId($platform['exampleTeam']);
            $teamArea=$exampleTeam['area'];
            $teamPitchVideoUrl=$exampleTeam['pitch_video_url'];
            $teamPitchVideoYouTubeId=$exampleTeam['pitch_video_you_tube_id'];
        }
        return A::merge($platform, compact('teamArea','teamPitchVideoUrl','teamPitchVideoYouTubeId'));
    }
};