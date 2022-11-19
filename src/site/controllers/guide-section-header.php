<?php
return function($kirby, $pages, $page) {
    return $page->next()->go();
};
