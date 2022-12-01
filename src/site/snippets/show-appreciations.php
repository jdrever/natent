<?php
//TODO: get proper url
$otherTeamPage="";
if (count($appreciations)>0) :?>
  <button class="btn-outline-primary btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAppreciations<?=$contentId?>" aria-expanded="false" aria-controls="collapseAppreciations<?=$contentId?>">
    <?=t("See Appreciations")?> <span class="badge bg-secondary"><?=count($appreciations)?></span>
  </button>
  <div class="collapse" id="collapseAppreciations<?=$contentId?>">
    <div class="card card-body">
  <?php foreach ($appreciations as $appreciation) :?>
    <p class="p-1 border"><i class="bi bi-stars"></i> <a href="<?=$otherTeamPage?>?teamId=<?=$appreciation['team_id']?>"><?=$appreciation['team_name']?></a></p>
  <?php endforeach ?>
        </div>
    </div>
<?php endif ?>