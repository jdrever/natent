<?php

$subPages=$page->children()->filter(function ($child) {
  return $child->translation(kirby()->language()->code())->exists();
});

if (count($subPages)>0) :
?>
<div class="container px-4">
  <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
    <?php foreach($subPages as $subPage): ?>
    <div class="col">
      <div class="d-grid gap-2">
        <a href="<?= $subPage->url() ?>" class="btn btn-lg btn-primary btn-block"><?= $subPage->pageTitle()->isEmpty() ? $subPage->title()->html() : $subPage->pageTitle()->html() ?></a>
      </div>
    </div>
    <?php endforeach ?>
  </div>
</div>
<?php endif ?>