<?php if (count($page->children()->filterBy('template','resource-area'))>0) :
?>
<div class="container bg-light p-4">
  <div class="container px-4">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
      <?php foreach ($page->children()->filterBy('template','resource-area') as $area) :  ?>
      <div class="card shadow-sm">
        <div class="card-body">
          <h3 class="card-text"><?= $area->title() ?></h3>
          <?php if($image = $area->image()): ?>
          <img class="img-thumbnail rounded mx-auto d-block" src="<?= $image->url() ?>" alt="" width="250" height="250">
          <?php endif ?>
          <?= $area->description()->kt() ?>
          <a href="<?=$area->url()?>" type="button" class="btn btn-primary m-2">EXPLORE &rarr;</a>
        </div>
      </div>
      <?php endforeach ?>
    </div>
  </div>
</div>
<?php endif ?>