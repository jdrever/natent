<?php
use carefulcollab\helpers as helpers;
return function($kirby, $pages, $page, $site) {
    $requiresLogin = true;
    $platform = $kirby->controller('platform', compact('page', 'pages', 'kirby', 'site', 'requiresLogin'));
    $team = $platform['team'];
    $country = $platform['country'];

    if($kirby->request()->is('POST')) 
    {
        $designFileUrl = "";
        $designIdeaUrl = "";
        $designIdeaYouTubeId = "";
        $result = helpers\FileHelper::uploadFiletoS3('designIdeaFile');

        if ($result->wasSuccessful)
        {
            //if no new file but is existing file use that
            if (empty($result->fileURL) && isset($_POST['existingDesignIdeaFile']))
                $designFileUrl = get('existingDesignIdeaFile');
            else
                $designFileUrl = $result->fileURL;
        }
      
        if (isset($_POST['designIdeaUrl']) && !empty($_POST['designIdeaUrl']))
        {
            $designIdeaUrl = str_replace("https://", "", get('designIdeaUrl'));
            if (str_starts_with($designIdeaUrl, "youtu.be/"))
            {
                $designIdeaYouTubeId = str_replace("youtu.be/", "", $designIdeaUrl);
            }
            else
            {
                parse_str(parse_url($designIdeaUrl, PHP_URL_QUERY), $designIdeaUrlVars);
                $designIdeaYouTubeId = $designIdeaUrlVars['v'];
            }
        
            $result = helpers\DataHelper::updateTeamWithDesignIdea($team['user_id'], $designFileUrl, $designIdeaUrl, $designIdeaYouTubeId);

            return $kirby->controller('result', compact('page', 'site', 'result', 'country'));
        }
    }
    else
    {
        return A::merge($platform, [
            'showForm' => true
        ]);
    }
};