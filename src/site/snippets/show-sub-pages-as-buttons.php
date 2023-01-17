<?php

$subPages=$page->children()->filter(function ($child) {
  return $child->translation(kirby()->language()->code())->exists();
});

if (count($subPages)>0) :
?>
<div class="container px-4" id="featured-3">
  <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
    <?php foreach($subPages as $subPage): ?>
    <div class="feature col">
      <a href="<?= $subPage->url() ?>" class="btn btn-lg btn-outline-secondary"><?= $subPage->pageTitle()->isEmpty() ? $subPage->title()->html() : $subPage->pageTitle()->html() ?></a>
    </div>
    <?php endforeach ?>
  </div>
</div>
<?php endif ?>