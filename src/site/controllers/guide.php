<?php
use carefulcollab\helpers as helpers;

return function($kirby, $pages, $page, $site) {
    $platform = $kirby->controller('platform' , compact('page', 'pages', 'kirby', 'site'));
    $team=$platform['team'];

    $phaseCompletionInfo=helpers\DataHelper::getCompletionByPhaseTypeForTeam($team['id'],$page->phase());
    $phaseCompletion = $phaseCompletionInfo['percent_complete'];

     return A::merge($platform, compact('phaseCompletion'));
};
