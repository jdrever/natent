<?php
use carefulcollab\helpers as helpers;

return function($kirby, $pages, $page, $site) {
    $requiresLogin = true;
    $platform = $kirby->controller('platform' , compact('page', 'pages', 'kirby', 'site', 'requiresLogin'));
    $team = $platform['team'];
    $country = $platform['country'];
    
    if($kirby->request()->is('POST')) 
    {
        $questionIds = explode(',', $_POST['questionIds']);
        $responses = array();

        foreach ($questionIds as $questionId)
        {
            if (!empty($questionId))
            {
                $response = new helpers\PhaseReviewResponse();
                $response->questionId = $questionId;
                $response->responseType = $_POST['question' . $questionId . 'ResponseType'];

                $questionResponse = "";
                if (isset($_POST['question' . $questionId]))
                {
                    $questionResponse = htmlspecialchars($_POST['question' . $questionId]);
                }

                if ($response->responseType == 'NUMERIC')
                {
                    $response->numericResponse = $questionResponse;
                }
                else
                {
                    $response->textResponse = $questionResponse;
                }

                $responses []= $response;
            }
        }

        $result = helpers\DataHelper::addPhaseReviewResponse($team['user_id'], "Exit", $responses);

        $userId = $platform['userId'];
        $phaseType = $platform['phaseType'];

        return $kirby->controller('result', compact('page', 'site', 'kirby', 'result','country','userId','phaseType'));
    }
    else
    {
        $questions = helpers\DataHelper::getPhaseReviewQuestionsByPhaseType("Exit");
        return A::merge($platform, [
            'questions' => $questions,
            'showForm' => true
        ]);
    }
};