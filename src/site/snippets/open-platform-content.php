<?php
$currentGuide=$page->parents()->filterBy('template', 'guide')->first();
if (!isset($icon)) $icon="journal-text";
?>
<div class="container-fluid mt-3">
  <div class="row">
    <div class="col-md-3">
      <?php if ($currentGuide) ?>
      <div class="container p-2" style="background-color: <?=$phaseBackground?>;">
        <h2><?=$currentGuide->title() ?></h2>

        <div class="progress mt-1 mb-4" style="height:30px;">
          <div class="progress-bar bg-primary" role="progressbar" style="width: <?=$phaseCompletion?>%;" aria-valuenow="<?=$phaseCompletion?>" aria-valuemin="0"
            aria-valuemax="100">
            <?=$phaseCompletion?>%
          </div>
        </div>
      </div>
      <?php snippet('show-guide-contents', ['contents'=>$page->siblings()]) ?>
    </div>
    <div class="col-md-6">
      <h1 class="fw-bold"><i class="bi bi-<?=$icon?>"></i><?=$page->title()?></h1>
      <p class="has-medium-font-size lh-sm"><strong>
          <?=$page->description()?></p>
      </strong>
      </p>