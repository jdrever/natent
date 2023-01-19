<?php

$buttonText=($userLoggedIn) ? 'SELECT THIS TOPIC' : 'BROWSE THIS TOPIC';

?>

<div class="album py-5 bg-light">
  <div class="container">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
      <?php foreach ($areas as $area) : ?>
      <div class="col">
        <div class="card shadow-sm">
          <img class="img-fluid" src="<?=url('/assets/images/SDGs/' . $area['id'] . $imageFileEnding) ?>"
            alt="<?=$area['name']?>">
          <div class="card-body">
            <p class="card-text"><strong><?=t($area['name'],$area['name'])?></strong><br /><?=t($area['description'], $area['description'])?></p>
            <div class="d-flex justify-content-between align-items-center">
              <div class="btn-group">
                <a href="<?=$page->url()?>?topicId=<?=$area['id'] ?>"
                  class="btn btn-sm btn-primary float-end"><?=t($buttonText, $buttonText)?> &#8594;</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php endforeach ?>
    </div>
  </div>
</div>

<?php if (!$userLoggedIn) : ?>
  <?php snippet('guide-navigation') ?>  
<?php endif ?>
