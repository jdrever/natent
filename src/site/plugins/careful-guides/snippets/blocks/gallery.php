<?php 

$caption = $block->caption();
$crop    = $block->crop()->isTrue();
$ratio   = $block->ratio()->or('auto');
?>
<div class="container">
    <div class="row row-cols-2">
<?php foreach ($block->images()->toFiles() as $image) : ?>
        <div class="col">
<?php
    $alt     = $image->alt();
    $caption = $image->caption();
    //$crop    = $image->crop()->isTrue();
    $link    = $image->link();
    //$ratio   = $image->ratio()->or('auto');
    $src     = null;

    if ($block->fixedWidth()->isNotEmpty())
    {
        $image=$image->resize((int)$block->fixedWidth()->value());
    }
    $src = $image->url();

    $imgClass="figure-img img-fluid";
    $figCaptionClass="figure-caption";
?>
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
        </div>
<?php endforeach ?>
    </div>
</div> 