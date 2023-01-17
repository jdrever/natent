<?php
use carefulcollab\helpers as helpers;

return function($kirby, $pages, $page, $site) 
{
    $requiresLogin=false;
    $platform = $kirby->controller('platform' , compact('page', 'pages', 'kirby', 'site','requiresLogin'));
    $team=$platform['team'];
    $country=$platform['country'];

    if($kirby->request()->is('POST')) 
    {
        $topicId = get('topicId');
        $bespokeChallenge = htmlspecialchars(get('bespokeChallenge',''));
        $challengeId = get('challengeId');
        $result=helpers\DataHelper::updateTeamChallenge($team['user_id'], $topicId, $challengeId,$bespokeChallenge); 

        $userId=$platform['userId'];
        $phaseType=$platform['phaseType'];
        return $kirby->controller('result', compact('page', 'site', 'kirby', 'result','country','userId','phaseType'));

    }
    else if (get('topicId'))
    {
        $topicId=get('topicId');
        $topic=helpers\DataHelper::getAreaToInvestigate($topicId);
        $challenges=helpers\DataHelper::getChallengesInArea($team['user_id'], $topicId);
        $bespokeChallenge='';
        if ($team['bespoke_challenge']==1) $bespokeChallenge=$team['challenge'];

        $teams = helpers\DataHelper::getTeamsByAreaId($topicId);

        return A::merge($platform, [
            'topic' => $topic,
            'challenges' => $challenges,
            'teams' => $teams,
            'showTopics' => false,
            'showChallenges' => true,
            'bespokeChallenge' => $bespokeChallenge,
        ]);
    }
    else
    {
        $currentLang=$kirby->language()->code();
        $areas=helpers\DataHelper::getAreasWithAvailableChallenges($team['user_id'], $currentLang);

        
    
        $imageFileEnding=".png";
        if ($currentLang=='lv')
            $imageFileEnding='-lv.jpg';
        if ($currentLang=='nl')
            $imageFileEnding='-nl.png';
        if ($currentLang=='de')
            $imageFileEnding='-de.jpg';
        if ($currentLang=='ro')
            $imageFileEnding='-ro.png';

        return A::merge($platform,[
            'showTopics' => true,
            'showChallenges' => false,
            'areas' => $areas,
            'imageFileEnding' => $imageFileEnding
        ]);
    };
};