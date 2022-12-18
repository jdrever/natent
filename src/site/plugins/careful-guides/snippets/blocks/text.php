<?php /** @var \Kirby\Cms\Block $block */ ?>
<?php
$divClass="";
if ($block->backgroundColour()->isNotEmpty() and $block->backgroundColour() != "#")
{
  $divClass.=' has-background';
  $divStyle='background-color:'. $block->backgroundColour().';';
}
?>
<?php if (!empty($divClass)) : ?>
<div class="<?=$divClass ?>" <?php if (!empty($divStyle)) : ?>style="<?=$divStyle?>" <?php endif ?>>
<?php endif ?>
    <?= $block->text();?>
<?php if (!empty($divClass)) : ?>
</div>
<?php endif ?>