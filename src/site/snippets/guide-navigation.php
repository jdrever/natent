<?php if ($page->hasPrev()): ?>
  <a class="btn btn-link m-2" href="<?= $page->prev()->url() ?>">← PREVIOUS <?=$page->prev()->title()?></a>
<?php else: ?>
  <a class="btn btn-link m-2" href="<?= $page->parent()->url() ?>">← PREVIOUS <?=$page->parent()->title()?></a>
<?php endif ?>

<?php if ($page->hasChildren()): ?>
  <a class="btn btn-primary m-2" href="<?= $page->children()->first()->url() ?>" role="button">
        NEXT  <?=$page->children()->first()->title()?> →
  </a>
<?php elseif ($page->hasNext()): ?>
  <a class="btn btn-primary m-2" href="<?= $page->next()->url() ?>" role="button">
        NEXT <?= $page->next()->title() ?>  →
  </a>
<?php endif ?>