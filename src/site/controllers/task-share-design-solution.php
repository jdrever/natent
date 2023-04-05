<?php
use carefulcollab\helpers as helpers;

return function($kirby, $pages, $page, $site) {
    $requiresLogin = false;
    $platform = $kirby->controller('platform', compact('page', 'pages', 'kirby', 'site', 'requiresLogin'));
    $team = $platform['team'];
    $country = $platform['country'];
    $userLoggedIn=$platform['userLoggedIn'];

    if($kirby->request()->is('POST')) 
    {
        try
        {
            $designFileUrl = "";
            $designIdeaUrl = "";
            $designIdeaYouTubeId = "";

            $userId=$platform['userId'];
            $phaseType=$platform['phaseType'];

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
            }
            $result = helpers\DataHelper::updateTeamWithDesignIdea($team['user_id'], $designFileUrl, $designIdeaUrl, $designIdeaYouTubeId);
        }
        catch (Exception $e)
        {
            $result->wasSuccessful=false;
            $result->errorMessage=$e;
            $result->pointsAdded=0;

        }
        return $kirby->controller('result', compact('page', 'site', 'kirby', 'result','country','userId','phaseType'));
        
    }
    else
    {
        if ($userLoggedIn)
        {
            $teamArea=$team['area'];
            $teamDesignFile=$team['design_idea_file'];
            $teamDesignUrl=$team['design_idea_url'];
            $teamDesignYouTubeId=$team['design_idea_you_tube_id'];

        }
        else
        {
            $exampleTeam=helpers\DataHelper::getTeamByTeamId($platform['exampleTeam']);
            $teamArea=$exampleTeam['area'];
            $teamDesignFile=$exampleTeam['design_idea_file'];
            $teamDesignUrl=$exampleTeam['design_idea_url'];
            $teamDesignYouTubeId=$exampleTeam['design_idea_you_tube_id'];
        }
        return A::merge($platform, compact('teamArea','teamDesignFile','teamDesignUrl','teamDesignYouTubeId'));
    }
};