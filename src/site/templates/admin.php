<?php snippet('header') ?>
<?php snippet('platform-menu') ?>
<div class="container my-4">
  <h1 class="pb-2 border-bottom"><i class="bi bi-gear-fill"></i> <?= $page->pageTitle()->isNotEmpty() ? $page->pageTitle() : $page->title() ?></h1>
<?php snippet ('show-blocks') ?>
<?php snippet('admin/show-admin-sub-pages') ?>
</div>
<?php snippet('footer') ?>