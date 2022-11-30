<?php /** @var \Kirby\Cms\Block $block */ 
$centreBlock=false;
$div="";
if ($block->isCentred()->isNotEmpty())
{
  if ($block->isCentred()->toBool()) 
  {
    $div='class="mx-auto d-block"';
  }
}
?>
<?php if (!$div=="") : ?>
<div <?=$div ?>>
<?php endif ?>
<<?= $level = $block->level()->or('h2') ?>><?= $block->text() ?></<?= $level ?>>
<?php if (!$div=="") : ?>
</div>
<?php endif ?>
