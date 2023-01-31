<?php snippet('header') ?>
<?php snippet('breadcrumb') ?>
<div class="container my-4">
  <h1><?=$page->pageTitle()->isNotEmpty() ?$page->pageTitle() : $page->title()?></h1>
<?php snippet('show-blocks') ?>
</div>
<?php snippet('footer') ?>
