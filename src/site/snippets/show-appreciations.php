<?php 
use carefulcollab\helpers as helpers;
if (!isset($appreciations)||(empty($appreciations))) $appreciations=helpers\DataHelper::getAppreciationsByContentId($team['user_id'],$contentType,$contentId);
?>

<?php
if (count($appreciations)>0) :?>
  <button class="btn-outline-primary btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAppreciations<?=$contentId?>" aria-expanded="false" aria-controls="collapseAppreciations<?=$contentId?>">
    <?=t("See Appreciations")?> <span class="badge bg-secondary"><?=count($appreciations)?></span>
  </button>
  <div class="collapse" id="collapseAppreciations<?=$contentId?>">
    <div class="card card-body">
  <?php foreach ($appreciations as $appreciation) :?>
    <p class="p-1 border"><i class="bi bi-stars"></i> <a href="<?=$otherTeamPage->url()?>?teamId=<?=$appreciation['team_id']?>"><?=$appreciation['team_name']?></a></p>
  <?php endforeach ?>
        </div>
    </div>
<?php endif ?>