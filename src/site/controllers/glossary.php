<?php
use carefulcollab\helpers as helpers;
return function($kirby, $pages, $page, $site) 
{
    $requiresLogin=true;
    $isNonLearningJourneyPage=true;
    $platform = $kirby->controller('platform' , compact('kirby', 'pages', 'page', 'site', 'requiresLogin', 'isNonLearningJourneyPage'));
    $glossary=$page->children()->filter(function ($child) {
        return $child->translation(kirby()->language()->code())->exists();
      });
      return A::merge($platform , compact('glossary'));   
};