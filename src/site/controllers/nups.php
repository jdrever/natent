<?php
return function($kirby, $pages, $page, $site) 
{
    $requiresLogin=false;
    $isNonLearningJourneyPage=true;
    $platform = $kirby->controller('platform' , compact('kirby', 'pages', 'page', 'site', 'requiresLogin', 'isNonLearningJourneyPage'));
    $nups=$page->children()->filter(function ($child) {
        return $child->translation(kirby()->language()->code())->exists();
      });
    return A::merge($platform , compact('nups'));
    
};