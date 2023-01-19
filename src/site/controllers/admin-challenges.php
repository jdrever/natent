<?php
use carefulcollab\helpers as helpers;
use carefulcollab\helpers\DataResult;

return function($kirby, $pages, $page, $site) {
    $requiresLogin = true;
    $platform = $kirby->controller('platform' , compact('page', 'pages', 'kirby', 'site', 'requiresLogin'));
    $team = $platform['team'];
    $country = $platform['country'];
    $userId = $team['user_id'];
    $result = new DataResult();
    $actionType='';
    $selectedTab='add';
    
    if($kirby->request()->is('POST')) 
    {
        $action=$_POST['action'];
        if ($action=="ADD-NEW-CHALLENGE")
        {
            $actionType="adding of a new Challenge";
            $challengeName=$_POST['challengeName'];
            $challengeDescription=$_POST['challengeDescription'];
            $challengeFurtherInformation=$_POST['challengeFurtherInformation'];
            $topicId=$_POST['topicId'];
            $topicId2=$_POST['topicId2'];
            if (empty($topicId2)) $topicId2=0;
            $topicId3=$_POST['topicId3'];
            if (empty($topicId3)) $topicId3=0;
            $topicId4=$_POST['topicId4'];
            if (empty($topicId4)) $topicId4=0;
            $topicId5=$_POST['topicId5'];
            if (empty($topicId5)) $topicId5=0;        
            $result=helpers\DataHelper::addChallenge($userId, $challengeName,$challengeDescription,$challengeFurtherInformation,$topicId,$topicId2,$topicId3,$topicId4,$topicId5);
        }
    
        if ($action=="REMOVE-CHALLENGE")
        {
            $actionType="removal of a Challenge";
            $challengeId=$_POST['challengeId'];
            $result=helpers\DataHelper::removeChallenge($userId, $challengeId);
            $selectedTab='edit';
        }
    
    
        if ($action=="UPDATE-CHALLENGE")
        {
            $actionType="updating of a Challenge";
            $challengeId=$_POST['challengeId'];
            $challengeName=$_POST['challengeName'];
            $challengeDescription=$_POST['challengeDescription'];
            $challengeFurtherInformation=$_POST['challengeFurtherInformation'];
            $topicId=$_POST['topicId'];
            $topicId2=$_POST['topicId2'];
            if (empty($topicId2)) $topicId2=0;
            $topicId3=$_POST['topicId3'];
            if (empty($topicId3)) $topicId3=0;
            $topicId4=$_POST['topicId4'];
            if (empty($topicId4)) $topicId4=0;
            $topicId5=$_POST['topicId5'];
            if (empty($topicId5)) $topicId5=0;  
            $result=helpers\DataHelper::updateChallenge($userId, $challengeId, $challengeName,$challengeDescription,$challengeFurtherInformation,$topicId,$topicId2,$topicId3,$topicId4,$topicId5);
            $selectedTab='edit';
        }
    }
    $topics = helpers\DataHelper::getAreasToInvestigate();
    $challenges = helpers\DataHelper::getChallengesForCountry($userId);
    return A::merge($platform, compact('topics','challenges','result', 'actionType','selectedTab'));
};