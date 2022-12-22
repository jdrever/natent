<?php snippet('header') ?>
<?php snippet('platform-menu') ?>
<?php snippet('breadcrumb') ?>
<?php snippet('show-status') ?>
<div class="container my-4">
<h1 class="pb-2 border-bottom"><?= $page->term()->isNotEmpty() ? $page->term() : $page->title() ?></h1>
<h2><?=t('Definition','Definition')?></h2>
<?=$page->definition()?>
</div>
<?php snippet('footer') ?>