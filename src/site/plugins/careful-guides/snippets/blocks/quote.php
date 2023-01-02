<?php /** @var \Kirby\Cms\Block $block */ ?>
<?php
$figureClass="";
if ($block->backgroundColour()->isNotEmpty() and $block->backgroundColour() != "#")
{
  $figureClass.=' has-background';
  $figureStyle='background-color:'. $block->backgroundColour().';';
}
?>
<figure <?php if (!empty($figureClass)) : ?> class="<?=$figureClass ?>" <?php endif ?> <?php if (!empty($figureStyle)) : ?>style="<?=$figureStyle?>" <?php endif ?>>
  <blockquote class="blockquote">
  <?= $block->text() ?>
  </blockquote>
  <?php if ($block->citation()->isNotEmpty()): ?>
  <figcaption class="blockquote">&mdash; <?= $block->citation() ?></figcaption>
  <?php endif ?>
</figure>