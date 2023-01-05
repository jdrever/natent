<?php 
use carefulcollab\helpers as helpers;

$width=300;
$height=200;

$phaseCol=4;
$hasPhases=false;

?>

<div class="container p-3">

  <div class="container">
    <div class="row">
      <div class="col"><h2><?=t('Welcome to the Platform!', 'Welcome to the Platform!')?></h2></div>
      <div class="col">
        <?=t('Select Your Country','Select Your Country')?>: <?php snippet('country-switcher') ?>
      </div>
      <div class="col">
        <?php if (Cookie::exists('resumePage')) : ?>
        <a href="<?=Cookie::get('resumePage')?>" class="btn btn-primary btn-lg m-2"><?=t('RESUME','RESUME')?> <i
            class="bi bi-arrow-right"></i></a>
        <?php else : ?>
        <a href="<?=$countryPhases[0]->url?>" class="btn btn-primary btn-lg m-2"><?=t('GET STARTED', 'GET STARTED')?> →</a>
        <?php endif ?>
      </div>
    </div>
  </div>
</div>
<div class="container p-2">
<p><strong><?=t('Work through each Phase below in order','Work through each Phase below in order')?>.</strong></p>
<div class="row">
<?php foreach ($countryPhases as $phase) : ?>
      <div class="col">
        <div class="d-grid gap-2">
      <a href="<?=$phase->url?>" class="btn btn-outline-primary" <?php if ($phase->backgroundColour) : ?>style="background-color: <?=$phase->backgroundColour?>" <?php endif ?>>
        <span class="h4"><i class="bi bi-<?=$phase->phaseNumber?>-circle"></i><br><?=$phase->title?></span>
        <br><span class="badge bg-info"><?= $phase->phaseCompletion ?>%</span>
      </a>
        </div>
      </div>
    <?php endforeach ?>
</div>
</div>

