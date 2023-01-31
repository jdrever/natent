<?php 
$collection = $kirby->collection("guides-content");

if ($page->prev($collection))
{
  $previousPage=$page->prev($collection);
}

if(!isset($taskButton)||!$userLoggedIn)
{
  if ($next = $page->next($collection)) 
  {
    $nextPage=$page->next($collection);
  }
}
?>

<?php if (isset($previousPage)||isset($nextLinkTitle)||isset($taskButton)) : ?>
  <div class="my-4">
  <?php if (isset($previousPage)&&$previousPage->template()!='country') : ?>
<a class="btn btn-link m-2" href="<?= $previousPage->url() ?>"><i class="bi bi-arrow-left"></i> <?=t('PREVIOUS','PREVIOUS')?>: <?=$previousPage->title()?></a>
  <?php endif ?>
  <?php if (isset($nextPage)&&!in_array($nextPage->template(), array('country','team-page'))) : ?>
<a class="btn btn-primary m-2" href="<?= $nextPage->url() ?>"><?=t('NEXT','NEXT')?>: <?=$nextPage->title()?> <i class="bi bi-arrow-right"></i></a>
  <?php endif ?>
  <?php if (isset($taskButton)&&$userLoggedIn) : ?>
    <button type="submit" class="btn btn-primary float-end"><?=$taskButton?> <i class="bi bi-arrow-right"></i></button>
  <?php endif ?>
  </div>
<?php endif ?>
