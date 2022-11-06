<?php snippet('header') ?>

<h1><?=$page->title()?></h1>
<?php if($image = $page->image()): ?>
<img class="img-thumbnail" src="<?= $image->url() ?>" alt="" width="250" height="250">
<?php endif ?>
<p class="lead"><?=$page->description()?></p>
<?php snippet('show-blocks') ?>
<p>This area contains the following resources:</p>
<?php snippet('show-resources') ?>

<?php snippet('footer') ?>