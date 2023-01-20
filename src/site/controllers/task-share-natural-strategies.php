<?php
use carefulcollab\helpers as helpers;
return function($kirby, $pages, $page, $site) {
    $requiresLogin=false;
    $platform = $kirby->controller('platform' , compact('page', 'pages', 'kirby', 'site','requiresLogin'));
    $team=$platform['team'];
    $country=$platform['country'];
    $userLoggedIn=$platform['userLoggedIn'];
    
    if($kirby->request()->is('POST')) 
    {
        $functionNumbers = explode(',', $_POST['functionNumbers']);
        $strategies = array();

        foreach ($functionNumbers as $functionNumber)
        {
            for ($x = 1; $x <= 6; $x++)
            {
                $strategyId = $functionNumber . 'strategy' . $x;
                $strategyName = "";
                if (isset($_POST[$strategyId])) 
                { 
                    $strategyName = get($strategyId); 
                }
                $principleId = $functionNumber . 'principle' . $x;
                $principleName = "";
                if (isset($_POST[$principleId])) 
                { 
                    $principleName = get($principleId); 
                }

                if (!empty($strategyName))
                {
                    $strategy = new helpers\NaturalStrategy();
                    $strategy->functionNumber = $functionNumber;
                    $strategy->strategyName = htmlspecialchars($strategyName);
                    $strategy->strategyNumber = $x;
                    $strategy->designPrinciple = htmlspecialchars($principleName);
                    $strategies[] = $strategy;
                }
            }
        }
        
        $result = helpers\DataHelper::updateTeamWithNaturalStrategies($team["user_id"], $strategies);

        $userId=$platform['userId'];
        $phaseType=$platform['phaseType'];
        return $kirby->controller('result', compact('page', 'site', 'kirby', 'result','country','userId','phaseType'));
    }
    else
    {
        if ($userLoggedIn)
        {
            $teamFunctions = helpers\DataHelper::getFunctionsByTeam($team['id'], false);
            $teamArea=$team['area'];
            $teamId=$team['id'];
        }
        else
        {
            $exampleTeam=helpers\DataHelper::getTeamByTeamId($platform['exampleTeam']);
            $teamFunctions = helpers\DataHelper::getFunctionsByTeam($exampleTeam['id'], false);
            $teamArea=$exampleTeam['area'];
            $teamId=$exampleTeam['id'];
        }
        $teamStrategies = array();

        foreach ($teamFunctions as $function) 
        {
            $functionNumber = $function['function_number'];
            $teamStrategies[$functionNumber] = helpers\DataHelper::getNaturalStrategiesByFunctionNumber($teamId, $functionNumber, false);
        }

        //echo(var_dump($teamFunctions));
        return A::merge($platform, compact('teamFunctions','teamStrategies','teamArea'));
    }
};