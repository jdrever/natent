<?php snippet('header') ?>
<?php snippet('platform-menu') ?>
<?php snippet('breadcrumb') ?>
<?php snippet('show-status') ?>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-3">
      <div class="container p-3" style="border:5px solid <?=$phaseBackground?>;">
        <h4 class="fw-bold"><?=$page->title()?></h4>
        <img src="/assets/images/<?=$phaseNumber?>.svg" width="100"> 
        <div class="progress mt-1 mb-4" style="height:30px;">
          <div class="progress-bar" role="progressbar" style="width: <?=$phaseCompletion?>%; background-color: <?=$phaseBackground ?>"
            aria-valuenow="<?=$phaseCompletion?>" aria-valuemin="0" aria-valuemax="100">
            <?=$phaseCompletion?>%
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <p class="has-medium-font-size lh-sm"><strong>
          <?=$page->description()?></p>
      </strong>
      </p>
      <?php snippet('show-blocks') ?>
      <?php snippet('guide-navigation') ?>
      <?php snippet('show-guide-contents') ?>
      </main>
    </div>
  </div>
</div>
</div>
<?php snippet('footer') ?>