<div class="container p-2">
  <div class="row">
    <div class="col">
      <h1><?=t('Welcome to the Platform!', 'Welcome to the Platform!')?></h1>
    </div>
  </div>
  <div class="row row-cols-1 row-cols-sm-2">
    <div class="col">
      <h4><?=t('Work through each Phase in order','Work through each Phase in order')?>.</h4>
    </div>
    <div class="col">
      <?php if (Cookie::exists('resumePage')) : ?>
      <a href="<?=Cookie::get('resumePage')?>" class="btn btn-primary btn-lg m-2"><?=t('RESUME','RESUME')?> <i
          class="bi bi-arrow-right"></i></a>
      <?php else : ?>
        <?php if (isset($languagePhases[0])) : ?>
      <a href="<?=$languagePhases[0]->url?>" class="btn btn-primary btn-lg m-2"><?=t('GET STARTED', 'GET STARTED')?>
        →</a>
        <?php endif ?>
      <?php endif ?>
    </div>
  </div>
  <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4">
    <?php foreach ($languagePhases as $phase) : ?>
    <div class="col">
      <div class="d-grid gap-2">
        <a href="<?=$phase->url?>" class="btn btn-outline"
          <?php if ($phase->backgroundColour) : ?>style="border: 5px solid <?=$phase->backgroundColour?>"
          <?php endif ?>>
          <img src="/assets/images/<?=$phase->phaseNumber?>.svg" width="100"><br> 
          <span class="h4" style="color: <?=$phase->backgroundColour?>"><?=$phase->title?></span>
        </a>
      </div>
      <div class="progress mt-1 mb-4" style="height:30px;">
          <div class="progress-bar" role="progressbar" style="width: <?=$phase->phaseCompletion ?>%; background-color: <?=$phase->backgroundColour?>"
            aria-valuenow="<?=$phase->phaseCompletion ?>" aria-valuemin="0" aria-valuemax="100">
            <?=$phase->phaseCompletion ?>%
          </div>
        </div>
    </div>
    <?php endforeach ?>
  </div>
</div>