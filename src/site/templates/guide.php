<?php snippet('header') ?>
<div class="container-fluid mt-4 mx-auto" style="width: 80%;">
    <main>
      <h1><?=$page->title()?></h1>
      <?php if($image = $page->image()): ?>
      <img class="img-thumbnail" src="<?= $image->url() ?>"alt="" width="250" height="250">
      <?php endif ?>
      <p class="lead"><?=$page->description()?></p>
      <?php snippet('show-blocks') ?> 
      <?php snippet('guide-navigation') ?> 
    </main>
  </div>
<?php snippet('footer') ?>
