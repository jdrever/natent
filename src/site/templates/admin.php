<?php snippet('header') ?>
<?php snippet ('show-simple-hero') ?>
<div class="container my-4">
  <h1 class="pb-2 border-bottom"><i class="bi bi-gear-fill"></i> <?= $page->pageTitle()->isNotEmpty() ? $page->pageTitle() : $page->title() ?></h1>
<?php snippet ('show-blocks') ?>
<?php snippet('show-sub-pages', ['buttonText'=>'GO']) ?>
</div>
<?php snippet('footer') ?>