<?php
return function($kirby, $pages, $page) {
    $platform = $kirby->controller('platform' , compact('page', 'pages', 'kirby', 'site'));
    return $platform;
};
