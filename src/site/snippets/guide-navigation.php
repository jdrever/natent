<?php 

if ($page->hasPrev())
{
  $previousLinkTitle=$page->prev()->title();
  $previousLinkUrl=$page->prev()->url();
}
elseif ($page->hasParent())
{
  $previousLinkTitle=$page->parent()->title();
  $previousLinkUrl=$page->parent()->url();
}

if(!isset($taskButton))
{
  if ($page->hasChildren())
  {
    $nextLinkTitle=$page->children()->first()->title();
    $nextLinkUrl=$page->children()->first()->url();
  }
  elseif ($page->hasNext())
  {
    $nextLinkTitle=$page->next()->title();
    $nextLinkUrl=$page->next()->url();
  }
}
?>

<?php if (isset($previousLinkTitle)||isset($nextLinkTitle)||isset($taskButton)) : ?>
  <div class="my-4">
  <?php if (isset($previousLinkTitle)) : ?>
<a class="btn btn-link m-2" href="<?= $previousLinkUrl ?>"><i class="bi bi-arrow-left"></i> PREVIOUS <?=$previousLinkTitle?></a>
  <?php endif ?>
<?php if (isset($nextLinkTitle)) : ?>
<a class="btn btn-primary p-3" href="<?= $nextLinkUrl ?>">NEXT: <?=$nextLinkTitle?><i class="bi bi-arrow-right"></i></a>
  <?php endif ?>
  <?php if (isset($taskButton)) : ?>
    <input type="submit" class="btn btn-primary float-end" value="<?=$taskButton?> &rarr;">
  <?php endif ?>
  </div>
<?php endif ?>
