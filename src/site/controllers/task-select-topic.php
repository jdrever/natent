<?php
include 'helpers/DataHelper.php';

use carefulcollab\helpers as helpers;

return function($kirby, $pages, $page) 
{


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
    else
    {
        $userId='1';
        $areas=helpers\DataHelper::getAreasWithAvailableChallenges($userId);
    
        $imageFileEnding=".png";
        if (pll_current_language()=='lv')
            $imageFileEnding='-lv.jpg';
        if (pll_current_language()=='nl')
            $imageFileEnding='-nl.png';
        if (pll_current_language()=='de')
            $imageFileEnding='-de.jpg';
        if (pll_current_language()=='ro')
            $imageFileEnding='-ro.png';
    }
    ;
};