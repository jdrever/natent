<?php 
use carefulcollab\helpers as helpers;

$phaseNumber=1;
$width=300;
$height=200;

$phaseCol=$userLoggedIn ? 1 : 2;
$hasPhases=false;
?>

<div class="container p-3" style="background-color:lemonchiffon;">
  <h2><?=t('Get Started!', 'Get Started!')?></h2>
  <div class="container">
    <div class="row">
      <div class="col">
        <?=t('Select Your Country','Select Your Country')?>: <?php snippet('country-switcher') ?>
      </div>
      <div class="col">
        <?php if (Cookie::exists('resumePage')) : ?>
        <a href="<?=Cookie::get('resumePage')?>" class="btn btn-primary m-2"><?=t('RESUME','RESUME')?> <i
            class="bi bi-arrow-right"></i></a>
        <?php else : ?>
        <a href="<?=$countryPhase->url()?>" class="btn btn-primary m-2"><?=t('GET STARTED', 'GET STARTED')?> →</a>
        <?php endif ?>
      </div>
    </div>
  </div>
  <p><strong><?=t('Work through each Phase below in order','Work through each Phase below in order')?>.</strong></p>
</div>
<div class="container">
  <div class="row row-cols-<?=$phaseCol?>">

<?php foreach ($phases as $phase) : 
    $pagesInPhase=$page->index()->filterBy('phase', strtolower($phase->title()));
    if ($pagesInPhase):
      $countryPhase=$pagesInPhase->filterBy('countries', '*=', str_replace(" ","-",strtolower($country)))->first();
      if ($countryPhase) :
        $phaseCompletionInfo=helpers\DataHelper::getCompletionByPhaseTypeForTeam($team['id'],$phase->title());
        $phaseCompletion = $phaseCompletionInfo['percent_complete']; ?>
    <div class="col p-3 m-1" <?php if ($phase->backgroundColour()->isNotEmpty()) : ?>style="background-color: <?=$phase->backgroundColour()?>" <?php endif ?>>
      <div class="d-grid gap-2">
      <a href="<?=$countryPhase->url()?>" class="btn btn-outline-primary">
        <span class="h2"><i class="bi bi-<?=$phaseNumber?>-circle"></i> <?=$phase->title()?></span>
        <span class="badge bg-info"><?= $phaseCompletion ?>%</span>
      </a>
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
