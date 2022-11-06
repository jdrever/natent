<?php if (count($page->children()->filterBy('template','resource'))>0) :
?>
<div class="container px-4">
  <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
    <?php foreach ($page->children()->filterBy('template','resource') as $resource) :  ?>
    <div class="col">
      <div class="card shadow-sm">
        <div class="card-body">
          <a href="<?=$resource->url()?>" type="button" class="btn btn-primary m-2"><?=$resource->title() ?></a>
        </div>
      </div>
    </div>
    <?php endforeach ?>
  </div>
</div>
<?php endif ?>
