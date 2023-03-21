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
        $functionsArray = array();
        for ($x = 1; $x <= 6; $x++)
        {
            if ((!empty($_POST['biologized' . $x]) or !empty($_POST['functionNumber' . $x])))
            {
                $function = new helpers\FunctionAndBiologizedQuestion();

                $functionNumber = get('functionNumber' . $x);
                $function->functionNumber = (!empty($functionNumber)) ? $functionNumber : $x;

                $function->functionName = "";
                $function->biologizedQuestion = htmlspecialchars(get('biologized' . $x)); 

                if (isset($_POST['remove'. $x]))
                {
                    $function->biologizedQuestion='';
                }

                $functionsArray[] = $function; 
            }
        }

        $result = helpers\DataHelper::updateTeamWithFunction($team['user_id'], $functionsArray);
        $userId=$platform['userId'];
        $phaseType=$platform['phaseType'];
        return $kirby->controller('result', compact('page', 'site', 'kirby', 'result','country','userId','phaseType'));
    }
    else
    {
        if ($userLoggedIn)
        {
            $teamFunctions = helpers\DataHelper::getFunctionsByTeam($team['id'], $team['challenge_id'], false);
            $teamArea=$team['area'];
        }
        else
        {
            $exampleTeam=helpers\DataHelper::getTeamByTeamId($platform['exampleTeam']);
            $teamFunctions = helpers\DataHelper::getFunctionsByTeam($exampleTeam['id'], false);
            $teamArea=$exampleTeam['area'];
        }
        return A::merge($platform, compact('teamFunctions', 'teamArea'));
    }
};