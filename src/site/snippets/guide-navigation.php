<?php 


$collection = $kirby->collection("guides-content");
if ($page->prev($collection))
{
  $previousLinkTitle=$page->prev($collection)->title();
  $previousLinkUrl=$page->prev($collection)->url();
}
elseif ($page->parent($collection))
{
  $previousLinkTitle=$page->parent($collection)->title();
  $previousLinkUrl=$page->parent($collection)->url();
}

if(!isset($taskButton))
{

  if ($next = $page->children($collection)->first())
  {
    $nextLinkTitle=$page->children($collection)->first()->title();
    $nextLinkUrl=$page->children($collection)->first()->url();
  }

  if ($next = $page->next($collection)) 
  {
    $nextLinkTitle=$page->next($collection)->title();
    $nextLinkUrl=$page->next($collection)->url();
  }
}
?>

<?php if (isset($previousLinkTitle)||isset($nextLinkTitle)||isset($taskButton)) : ?>
  <div class="my-4">
  <?php if (isset($previousLinkTitle)) : ?>
<a class="btn btn-link m-2" href="<?= $previousLinkUrl ?>"><i class="bi bi-arrow-left"></i> PREVIOUS: <?=$previousLinkTitle?></a>
  <?php endif ?>
<?php if (isset($nextLinkTitle)) : ?>
<a class="btn btn-primary m-2" href="<?= $nextLinkUrl ?>">NEXT: <?=$nextLinkTitle?> <i class="bi bi-arrow-right"></i></a>
  <?php endif ?>
  <?php if (isset($taskButton)) : ?>
    <button type="submit" class="btn btn-primary float-end"><?=$taskButton?> <i class="bi bi-arrow-right"></i></button>
  <?php endif ?>
  </div>
<?php endif ?>
