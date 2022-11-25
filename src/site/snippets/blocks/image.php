<?php

/** @var \Kirby\Cms\Block $block */
$alt     = $block->alt();
$caption = $block->caption();
$crop    = $block->crop()->isTrue();
$link    = $block->link();
$ratio   = $block->ratio()->or('auto');
$src     = null;

if ($block->location() == 'web') {
    $src = $block->src()->esc();
} elseif ($image = $block->image()->toFile()) {
    $alt = $alt ?? $image->alt();
    if ($block->fixedWidth()->isNotEmpty())
    {
      $image=$image->resize((int)$block->fixedWidth()->value());
    }
    $src = $image->url();
}

$imgClass="figure-img img-fluid";
$figCaptionClass="figure-caption";
$centreBlock=false;

if ($block->isCentred()->isNotEmpty())
{
  if ($block->isCentred()->toBool()) 
  {
    $centreBlock=true;
    $imgClass.=" mx-auto d-block";
    $figCaptionClass.=" text-center";
  }
}
?>
<?php if ($centreBlock) : ?>
<div class="mx-auto d-block">
<?php endif ?>
<?php if ($src): ?>
<figure<?= Html::attr(['data-ratio' => $ratio, 'data-crop' => $crop], null, ' ') ?>>
  <?php if ($link->isNotEmpty()): ?>
  <a href="<?= Str::esc($link->toUrl()) ?>">
    <img class="<?=$imgClass?>" src="<?= $src ?>" alt="<?= $alt->esc() ?>">
  </a>
  <?php else: ?>
  <img class="<?=$imgClass?>" src="<?= $src ?>" alt="<?= $alt->esc() ?>">
  <?php endif ?>

  <?php if ($caption->isNotEmpty()): ?>
  <figcaption class="<?=$figCaptionClass?>">
    <?= $caption ?>
  </figcaption>
  <?php endif ?>
</figure>
<?php endif ?>
<?php if ($centreBlock) : ?>
</div>
<?php endif ?>