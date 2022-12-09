<?php
return function($kirby, $pages, $page, $site) {
    $platform = $kirby->controller('platform' , compact('page', 'pages', 'kirby', 'site'));
    return $platform;
};
