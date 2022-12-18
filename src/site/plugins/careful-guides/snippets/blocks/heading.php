<?php /** @var \Kirby\Cms\Block $block */ 
$centreBlock=false;
$divClass="";
if ($block->isCentred()->isNotEmpty())
{
  if ($block->isCentred()->toBool()) 
  {
    $divClass='mx-auto d-block';
  }
}
if ($block->backgroundColour()->isNotEmpty() and $block->backgroundColour() != "#")
{
  $divClass.=' has-background';
  $divStyle='background-color:'. $block->backgroundColour().';';
}
?>
<?php if (!empty($divClass)) : ?>
<div class="<?=$divClass ?>" <?php if (!empty($divStyle)) : ?>style="<?=$divStyle?>" <?php endif ?>>
<?php endif ?>
<<?= $level = $block->level()->or('h2') ?>><?= $block->text() ?></<?= $level ?>>
<?php if (!empty($divClass)) : ?>
</div>
<?php endif ?>
