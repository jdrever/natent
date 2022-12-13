<?php

return function ($site) {
    return $site->find('platform')->index()->filterBy('template','!=','guide-section-header');
};