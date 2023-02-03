<?php

$buttonText=isset($buttonText) ? $buttonText : t('READ MORE','READ MORE');
$subPages=$page->children()->filter(function ($child) {
  return $child->translation(kirby()->language()->code())->exists();
});

if (count($subPages)>0) :
?>
<div class="container px-4" id="featured-3">
  <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
    <?php foreach($subPages as $subPage): ?>
    <div class="feature col">
      <h3 class="fs-2"><?= $subPage->pageTitle()->isEmpty() ? $subPage->title()->html() : $subPage->pageTitle()->html() ?></h3>
      <p><?= $subPage->description()->html() ?></p>
      <p><a href="<?= $subPage->url() ?>" class="btn btn-sm btn-outline-secondary"><?=t($buttonText,$buttonText)?></a></p>
    </div>
    <?php endforeach ?>
  </div>
</div>
<?php endif ?>