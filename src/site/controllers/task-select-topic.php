<?php
include 'helpers/DataHelper.php';

use carefulcollab\helpers as helpers;

return function($kirby, $pages, $page) 
{
    $userId="1";

    if($kirby->request()->is('POST')) 
    {
        $description = htmlspecialchars($_POST['description']);
        $skills = '';
        if (isset($_POST['skills'])) $skills = implode(',', $_POST['skills']);
        $result=helpers\DataHelper::updateTeamProfile(1, $description, $skills);
        $pointsToAdd = 20;

        if ($page = $page->next()){
            return $page->go();
          }
    }
    else if ($kirby->request()->get('topicId'))
    {
        $topicId=$_GET['topicId'];
        $topic=helpers\DataHelper::getAreaToInvestigate($topicId);
        $challenges=helpers\DataHelper::getChallengesInArea($userId, $topicId);
        $bespokeChallenge='';
        if ($team['bespoke_challenge']==1) $bespokeChallenge=$team['challenge'];

        $teams = helpers\DataHelper::getTeamsByAreaId($topicId);

        return [
            'topic' => $topic,
            'challenges' => $challenges,
            'teams' => $teams,
            'showChallenges' => true
        ];
    }
    else
    {
        $userId='1';
        $areas=helpers\DataHelper::getAreasWithAvailableChallenges($userId);

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
            'areas' => $areas,
            'imageFileEnding' => $imageFileEnding
        ];
    };
};