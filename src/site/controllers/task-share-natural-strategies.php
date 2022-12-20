<?php
use carefulcollab\helpers as helpers;
return function($kirby, $pages, $page, $site) {
    $requiresLogin=true;
    $platform = $kirby->controller('platform' , compact('page', 'pages', 'kirby', 'site','requiresLogin'));
    $team=$platform['team'];
    $country=$platform['country'];
    
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
        $functions = helpers\DataHelper::getFunctionsByTeamAndChallengeId($team['id'], $team['challenge_id'], false);
        $strategies = array();

        foreach ($functions as $function) 
        {
            $functionNumber = $function['function_number'];
            $strategies[$functionNumber] = helpers\DataHelper::getNaturalStrategiesByFunctionNumber($team["user_id"], $functionNumber, false);
        }

        return A::merge($platform, [
            'functions' => $functions,
            'strategies' => $strategies,
            'showForm' => true
        ]);
    }
};