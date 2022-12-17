<?php
$currentGuide=$page->parents()->filterBy('template', 'guide')->first();
if (isset($icon)) $icon="journal-text";
?>
<div class="container mt-3">
  <div class="row">
    <div class="col-12" d-none d-lg-block>

    </div>
  </div>
  <div class="row">
    <div class="col-md-3">
      <?php if ($currentGuide) ?>
      <h3><?=$currentGuide->title() ?></h3>
      <?php if($image = $page->image()): ?>
      <div>
        <!--<img class="img-fluid rounded" src="<?= $image->url() ?>" alt="" width="250" height="250"-->
      </div>
      <?php endif ?>
      <div class="progress mt-1 mb-4" style="height:30px;">
        <div class="progress-bar bg-primary" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0"
          aria-valuemax="100">
          50%
        </div>
      </div>
      <?php snippet('show-guide-contents', ['contents'=>$page->siblings()]) ?>
    </div>
    <div class="col">
      <h1 class="fw-bold"><i class="bi bi-<?=$icon?>"></i><?=$page->title()?></h1>
      <p class="has-medium-font-size lh-sm"><strong>
          <?=$page->description()?></p>
      </strong>
      </p>