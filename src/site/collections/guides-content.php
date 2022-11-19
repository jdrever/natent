<?php

return function ($site) {
    return $site->index()->listed()->filterBy('template','==','guide-section-header');
};