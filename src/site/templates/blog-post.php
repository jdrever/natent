<?php snippet('header') ?>
<h1><?=$page->title()?></h1>
<p><strong><?=$page->publishedDate()?></strong></p>
<p class="lead"><?=$page->openingContent()?></p>
<?php snippet('show-blocks')?>
<?php snippet('footer') ?>
