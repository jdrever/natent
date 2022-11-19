<?php
if(!isset($contents)) $contents=$page->children()->listed();
?>

<h3>Contents</h3>
<div class="list-group">
<?php foreach ($contents as $section) : ?>
  <?php if ($section->blueprint()->name()=='pages/guide-section-header') : ?>
    <div class="list-group-item list-group-item-dark"><?=$section->title()?></div>
  <?php endif ?>
  <?php if ($section->blueprint()->name()=='pages/guide-section') : ?>
    <a href="<?=$section->url()?>" class="list-group-item">
    <i class="bi bi-journal-text"></i>
     <?=$section->title()?>
  </a>
  <?php endif ?>
  <?php if (str_starts_with($section->blueprint()->name(),'pages/task')) : ?>
    <a href="<?=$section->url()?>" class="list-group-item">
    <i class="bi bi-list-check"></i>
     <?=$section->title()?>
  </a>
  <?php endif ?>
<?php endforeach ?>
</div>
