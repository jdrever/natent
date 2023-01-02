<?php 
use carefulcollab\helpers as helpers;

$phaseNumber=1;
$width=300;
$height=200;

$phaseCol=$userLoggedIn ? 1 : 2;
$hasPhases=false;

?>
<h2><?=t('The Phases', 'The Phases')?></h2>
<?=t('Country','Country')?>: <?php snippet('country-switcher') ?>
<p><?=t('Work through each Phase in order','Work through each Phase in order')?>.</p>

<?php foreach ($phases as $phase) : 
    $pagesInPhase=$page->index()->filterBy('phase', strtolower($phase->title()));
    if ($pagesInPhase):
      $countryPhase=$pagesInPhase->filterBy('countries', '*=', str_replace(" ","-",strtolower($country)))->first();
      if ($countryPhase) : ?>
<?php if ($phaseNumber==1) : ?>
<?php if (Cookie::exists('resumePage')) : ?>
<a href="<?=Cookie::get('resumePage')?>" class="btn btn-primary m-2"><?=t('RESUME','RESUME')?> <i
    class="bi bi-arrow-right"></i></a>
<?php else : ?>
<a href="<?=$countryPhase->url()?>" class="btn btn-primary m-2"><?=t('GET STARTED', 'GET STARTED')?> →</a>
<?php endif ?>
<div class="container">
  <div class="row row-cols-<?=$phaseCol?>">
    <?php endif ?>
    <div class="col">
      <a href="<?=$countryPhase->url()?>">
        <figure class="figure m-0">
          <figcaption class="figure-caption">
            <?=$phaseNumber?>. <?=$countryPhase->title()?>
          </figcaption>
          <?php if ($image = $phase->mainImage()->toImage()) : 
             $altText=$phase->mainImage()->toImage()->imageTitle() . " by " . $phase->mainImage()->toImage()->photographer() . " is marked with " . $phase->mainImage()->toImage()->license();
            
            ?>
          <img class="figure-img img-fluid rounded" src="<?=$image->clip($width)->url()?>" alt="<?=$altText?>"
            width="<?=$width?>" height="<?= $height ?>" loading="lazy">
          <?php endif ?>
        </figure>
      </a>
      <?php
      $phaseCompletionInfo=helpers\DataHelper::getCompletionByPhaseTypeForTeam($team['id'],$phase->title());
      $phaseCompletion = $phaseCompletionInfo['percent_complete'];
?>
      <div class="progress">
        <div class="progress-bar bg-primary" role="progressbar" style="width: <?= $phaseCompletion ?>%;"
          aria-valuenow="<?= $phaseCompletion ?>" aria-valuemin="0" aria-valuemax="100">
          <?= $phaseCompletion ?>%</div>
      </div>
    </div>
    <?php
      $hasPhases=true;
    endif;
  endif;  
  $phaseNumber++; 
endforeach; 
if ($hasPhases) :
?>
  </div>
</div>
<?php endif ?>
<div class="d-grid gap-2 d-md-flex justify-content-md-start">
  <button class="btn btn-primary btn-sm m-2" type="button" data-bs-toggle="collapse"
    data-bs-target="#collapseImageCredits" aria-expanded="false" aria-controls="collapseImageCredits">
    <?=t('See Image Credits')?>
  </button>
  <div class="collapse" id="collapseImageCredits">
    <?php foreach ($phases as $phase) : ?>
    <?php if ($image = $phase->mainImage()->toImage()) : 
$creditText=$phase->mainImage()->toImage()->imageTitle() . " by " . $phase->mainImage()->toImage()->photographer() . " is marked with " . $phase->mainImage()->toImage()->license();
  ?>
    <p>
      <small>
        <b><?=$phase->title()?></b>
        <?=$creditText?>
        <?php if ($licenseUrl=$phase->mainImage()->toImage()->licenseUrl()) : ?>
        To see license terms, visit <a href="<?=$licenseUrl?>" target="_blank"><?=$licenseUrl?></a>
        <?php endif ?>
      </small>
    </p>

    <?php endif ?>
    <?php endforeach ?>
  </div>
</div>