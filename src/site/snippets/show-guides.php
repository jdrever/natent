<?php
if (!isset($templateName))
{
  $templateName="guide";
}

if (!isset($showTitle))
{
  $showTitle="Guides";
}
?>
<?php if (count($page->children()->filterBy('template',$templateName))>0) :
?>
<div class="container bg-light p-4">
  <h2><?= $showTitle ?></h2>
  <div class="container px-4">
  <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
<?php foreach ($page->children()->filterBy('template',$templateName) as $guide) :  ?>
  <div class="card shadow-sm">
        <div class="card-body">
          <h3 class="card-text"><?= $guide->title() ?></h3>
          <?php if($image = $guide->image()): ?>
          <img class="img-thumbnail rounded mx-auto d-block" src="<?= $image->url() ?>"alt="" width="250" height="250">
          <?php endif ?>
        <?= $guide->description()->kt() ?>
        <a href="<?=$guide->url()?>" type="button" class="btn btn-primary m-2">START THE GUIDE &rarr;</a>
      </div>
<?php endforeach ?>
    </div>
  </div>
</div>
<?php endif ?>
<!--
<div class="container px-4">
  <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3"><div class="col">   
      <div class="card shadow-sm">
        <div class="card-body">
          <h3 class="card-text">Intentional Meditation</h3>
          
            <img class="img-thumbnail rounded mx-auto d-block" src="/images/guides/intentional_meditation.png" alt="" width="250" height="250">
          
          <p>You may find this guide useful if you have already started to meditate but haven&#39;t yet settled on a path.</p>

<p class="alert alert-warning">This guide is in its <strong>Discovery</strong> phase of development.  This means we are still at the early stages of experimenting with it.</p>



            <a href="/guides/intentional-meditation/" type="button" class="btn btn-primary m-2">START THE GUIDE &rarr;</a>
        </div>
      </div>
    </div>
-->
  