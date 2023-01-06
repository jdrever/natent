<?php
return function($kirby, $pages, $page, $site) 
{
    $requiresLogin=false;
    $isNonLearningJourneyPage=true;
    $registerPage=site()->find('register-your-school');
    return $kirby->controller('platform' , compact('kirby', 'pages', 'page', 'site', 'requiresLogin', 'isNonLearningJourneyPage', 'registerPage'));
    
};