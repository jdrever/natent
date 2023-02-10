
<?php snippet('header') ?>
<?php snippet('platform-menu') ?>
<?php snippet('show-status') ?>
<h1 class="pb-2 border-bottom"><i class="bi bi-cc-circle-fill"></i> <?= $page->pageTitle()->isNotEmpty() ? $page->pageTitle() : $page->title() ?></h1>
<?php snippet('show-blocks') ?>
<?php snippet('show-other-teams')?>
<?php snippet('footer') ?>
