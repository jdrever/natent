<?php 
$collection = $kirby->collection("guides-content")->filter(function ($p) use ($country)
{
    return (($p->template()!='guide')||($p->template()=='guide'&&(str_contains($p->countries(),strtolower($country)))));
});


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

  if ($next = $page->children($collection)->filterBy('template','!=','guide-section-header')->first())
  {
    $nextLinkTitle=$next->title();
    $nextLinkUrl=$next->url();
  }
  else if ($next = $page->next($collection)) 
  {
    $nextLinkTitle=$next->title();
    $nextLinkUrl=$next->url();
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
