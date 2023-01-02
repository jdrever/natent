<?php snippet('header') ?>
<?php snippet('platform-menu') ?>
<?php snippet('breadcrumb') ?>
<?php snippet('show-status') ?>
<div class="container my-4">
<h1 class="pb-2 border-bottom"><i class="bi bi-globe-europe-africa"></i> <?= $page->pageTitle()->isNotEmpty() ? $page->pageTitle() : $page->title() ?></h1>
<?php snippet ('show-blocks') ?>
<?php snippet('show-nups') ?>
</div>
<?php snippet('footer') ?>