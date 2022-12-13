<?php

return function ($site, $country) {
    return $site->index()->listed()->filterBy('template','!=','guide-section-header');
};