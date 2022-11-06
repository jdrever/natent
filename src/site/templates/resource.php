<?php snippet('header') ?>
<div class="container-fluid mt-4 mx-auto" style="width: 80%;">
    <main>
      <h1><?=$page->title() ?></h1>
    <?php snippet('show-blocks') ?>
    </main>
  </div>
<?php snippet('footer') ?>