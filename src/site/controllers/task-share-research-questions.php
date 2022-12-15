<?php
use carefulcollab\helpers as helpers;
return function($kirby, $pages, $page, $site) {
    $requiresLogin = true;
    $platform = $kirby->controller('platform' , compact('page', 'pages', 'kirby', 'site', 'requiresLogin'));
    $team = $platform['team'];
    $country = $platform['country'];
    
    if($kirby->request()->is('POST')) 
    {
        $functionsArray = array();
        for ($x = 1; $x <= 6; $x++)
        {
            if (!empty($_POST['biologized' . $x]) or !empty($_POST['functionNumber' . $x]))
            {
                $function = new helpers\FunctionAndBiologizedQuestion();

                $functionNumber = get('functionNumber' . $x);
                $function->functionNumber = (!empty($functionNumber)) ? $functionNumber : $x;

                $function->functionName = "";
                $function->biologizedQuestion = htmlspecialchars(get('biologized' . $x)); 
                $functionsArray[] = $function; 
            }
        }

        $result = helpers\DataHelper::updateTeamWithFunction($team['user_id'], $functionsArray);

        return $kirby->controller('result', compact('page', 'site', 'result','country'));
    }
    else
    {
        $functions = helpers\DataHelper::getFunctionsByTeamAndChallengeId($team['id'], $team['challenge_id'], false);
        return A::merge($platform, [
            'functions' => $functions,
            'showForm' => true
        ]);
    }
};