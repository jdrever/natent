<?php /** @var \Kirby\Cms\Block $block */ ?>
<blockquote class="blockquote">
  <?= $block->text() ?>
  <?php if ($block->citation()->isNotEmpty()): ?>
  <footer class="blockquote-footer">
    <?= $block->citation() ?>
  </footer>
  <?php endif ?>
</blockquote>