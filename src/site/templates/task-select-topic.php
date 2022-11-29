<?php snippet('header') ?>
<?php snippet('platform-menu') ?>
<?php snippet('breadcrumb') ?>
<?php snippet('open-platform-content') ?>
<?php snippet('show-blocks') ?>
<div class="album py-5 bg-light">
  <div class="container">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
      <?php 
$challengePage="#";
foreach ($areas as $area) : ?>
      <div class="col">
        <div class="card shadow-sm">
          <img class="img-fluid" src="<?=url('/assets/images/SDGs/' . $area['id'] . $imageFileEnding) ?>"
            alt="<?=$area['name']?>">
          <div class="card-body">
            <p class="card-text"><strong><?=trim($area['name'])?></strong><br /><?=trim($area['description'])?></p>
            <div class="d-flex justify-content-between align-items-center">
              <div class="btn-group">
                <a href="<?=$challengePage ?>/?areaId=<?=$area['id'] ?>"
                  class="btn btn-sm btn-primary float-end"><?=$page->selectTopicButton()?> &#8594;</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php endforeach ?>
    </div>
  </div>
</div>

<?php snippet('close-platform-content') ?>
<?php snippet('footer') ?>