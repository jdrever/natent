<?php
include 'helpers/DataHelper.php';

use carefulcollab\helpers as helpers;

return function($kirby, $pages, $page) {
    if($kirby->request()->is('POST')) {
        $description = htmlspecialchars($_POST['description']);
        $skills = '';
        if (isset($_POST['skills'])) $skills = implode(',', $_POST['skills']);
        $result=helpers\DataHelper::updateTeamProfile(1, 'TEST', $description, $skills);
        $pointsToAdd = 20;

        if ($page = $page->next()){
            return $page->go();
          }
    };
};