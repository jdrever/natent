<div class="container p-2">
  <div class="row">
    <div class="col">
      <h1><?=t('Welcome to the Platform!', 'Welcome to the Platform!')?></h1>
    </div>
  </div>
  <div class="row p-2 mb-3">
    <div class="col-8">
      <h4><?=t('Work through each Phase below in order','Work through each Phase below in order')?>.</h4>
    </div>
    <div class="col-4">
      <?php if (Cookie::exists('resumePage')) : ?>
      <a href="<?=Cookie::get('resumePage')?>" class="btn btn-primary btn-lg"><?=t('RESUME','RESUME')?> <i
          class="bi bi-arrow-right"></i></a>
      <?php else : ?>
      <a href="<?=$languagePhases[0]->url?>" class="btn btn-primary btn-lg"><?=t('GET STARTED', 'GET STARTED')?>
        →</a>
      <?php endif ?>
    </div>
  </div>
  <div class="row">
    <?php foreach ($languagePhases as $phase) : ?>
    <div class="col">
      <div class="d-grid gap-2">
        <a href="<?=$phase->url?>" class="btn btn-outline"
          <?php if ($phase->backgroundColour) : ?>style="border: 5px solid <?=$phase->backgroundColour?>"
          <?php endif ?>>
          <img src="/assets/images/<?=$phase->phaseNumber?>.svg" width="100"> 
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