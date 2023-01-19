<?php
use carefulcollab\helpers as helpers;

return function($kirby, $pages, $page, $site) 
{
    $requiresLogin=false;
    $platform = $kirby->controller('platform' , compact('page', 'pages', 'kirby', 'site','requiresLogin'));
    $team=$platform['team'];
    $country=$platform['country'];
    $userLoggedIn=$platform['userLoggedIn'];

    if ($userLoggedIn)
    {
        $teamArea=$team['area'];
        $teamChallenge=$team['challenge'];
    }
    else
    {
        $exampleTeam=helpers\DataHelper::getTeamByTeamId($platform['exampleTeam']);
        $teamArea=$exampleTeam['area'];
        $teamChallenge=$exampleTeam['challenge'];
    }



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
        $bespokeChallenge='';
        $teams=[];
        $topic=helpers\DataHelper::getAreaToInvestigate($topicId);
        
        if ($userLoggedIn)
        {
            $challenges=helpers\DataHelper::getChallengesInArea($team['country_id'], $topicId);
            if ($team['bespoke_challenge']==1) $bespokeChallenge=$team['challenge'];
            $teams = helpers\DataHelper::getTeamsByAreaId($topicId);
        }
        else
        {
            
            $challenges=helpers\DataHelper::getChallengesInArea($exampleTeam['country_id'], $topicId);
        }

        return A::merge($platform, [
            'topic' => $topic,
            'challenges' => $challenges,
            'teams' => $teams,
            'showTopics' => false,
            'showChallenges' => true,
            'teamArea' => $teamArea,
            'teamChallenge' => $teamChallenge,
            'bespokeChallenge' => $bespokeChallenge,
        ]);
    }
    else
    {
        $currentLang=$kirby->language()->code();

        if ($userLoggedIn)
        {
            $areas=helpers\DataHelper::getAreasWithAvailableChallenges($team['country_id']);
        }
        else
        {
            $exampleTeam=helpers\DataHelper::getTeamByTeamId($platform['exampleTeam']);
            $areas=helpers\DataHelper::getAreasWithAvailableChallenges($exampleTeam['country_id']);
        }    
        
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
            'teamArea' => $teamArea,
            'teamChallenge' => $teamChallenge,
            'areas' => $areas,
            'imageFileEnding' => $imageFileEnding
        ]);
    };
};