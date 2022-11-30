<?php
include 'helpers/DataHelper.php';

use carefulcollab\helpers as helpers;

return function($kirby, $pages, $page) 
{
    $platform = $kirby->controller('platform' , compact('page', 'pages', 'kirby'));
    $team=$platform['team'];

    if($kirby->request()->is('POST')) 
    {
        //to do
    }
    else if ($kirby->request()->get('topicId'))
    {
        $topicId=$_GET['topicId'];
        $topic=helpers\DataHelper::getAreaToInvestigate($topicId);
        $challenges=helpers\DataHelper::getChallengesInArea($team['user_id'], $topicId);
        $bespokeChallenge='';
        if ($team['bespoke_challenge']==1) $bespokeChallenge=$team['challenge'];

        $teams = helpers\DataHelper::getTeamsByAreaId($topicId);

        return [
            'topic' => $topic,
            'challenges' => $challenges,
            'teams' => $teams,
            'showTopics' => false,
            'showChallenges' => true,
        ];
    }
    else
    {
        $areas=helpers\DataHelper::getAreasWithAvailableChallenges($team['user_id']);

        $currentLang=$kirby->language()->code();
    
        $imageFileEnding=".png";
        if ($currentLang=='lv')
            $imageFileEnding='-lv.jpg';
        if ($currentLang=='nl')
            $imageFileEnding='-nl.png';
        if ($currentLang=='de')
            $imageFileEnding='-de.jpg';
        if ($currentLang=='ro')
            $imageFileEnding='-ro.png';

        return [
            'showTopics' => true,
            'showChallenges' => false,
            'areas' => $areas,
            'imageFileEnding' => $imageFileEnding
        ];
    };
};