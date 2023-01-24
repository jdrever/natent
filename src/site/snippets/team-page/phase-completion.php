
<div class="container my-4">
<h1 class="pb-2 border-bottom"><i class="bi bi-person-heart"></i> <?= $viewedTeam['name'] ?></h1>
  <div class="row p-3">
    <?php
        foreach ($phaseCompletion as $phase)
        {
            $phaseTitle = $phase[0];
            $phaseCompletion = $phase[1];
        ?>
    <div class="col">
      <h5><?= $phaseTitle ?></h5>
      <div class="progress">
        <div class="progress-bar bg-info" role="progressbar" style="width: <?= $phaseCompletion ?>%;"
          aria-valuenow="<?= $phaseCompletion ?>" aria-valuemin="0" aria-valuemax="100">
          <?= $phaseCompletion ?>%</div>
      </div>
    </div>
    <?php
        }
        ?>
    <div class="col">
      <h5><?= t("Points", "Points") ?></h5>
      <p class="h1"><?= $viewedTeam['points'] ?></p>
    </div>
  </div>
  

<?php if ($userRole==='ADMIN'||$userRole==='GLOBAL'||$userRole==='TEACHER'): ?>
<div class="row">
  <div class="col-12">
  <?php snippet('team-page/points') ?>
</div>
</div>
<?php endif ?>
</div>