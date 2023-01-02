<?php /** @var \Kirby\Cms\Block $block */ ?>

<figure>
  <blockquote class="blockquote">
  <?= $block->text() ?>
  </blockquote>
  <?php if ($block->citation()->isNotEmpty()): ?>
  <figcaption class="blockquote">&mdash; <?= $block->citation() ?></figcaption>
  <?php endif ?>
</figure>