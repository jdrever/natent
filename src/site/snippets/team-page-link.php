<?php
if ($userLoggedIn) :
  $teamArea = $team['area'];
  if (empty($teamArea)) $teamArea = t("Not yet selected","Not yet selected");

  $teamChallenge = $team['challenge'];
  if (empty($teamChallenge)) $teamChallenge = t("Not yet selected","Not yet selected");
?>

<div class="alert alert-info" role="alert">
  <p>
    <strong><?=t("Your team's selected Topic")?>: </strong> <?=t($teamArea,$teamArea)?>
    <br/>
    <strong><?=t("Your team's selected Challenge")?>: </strong> <?=$teamChallenge?>
  </p>
  <p><?=t("You can see full details on your Team Page", "You can see full details on your Team Page")?>
  <p><a href="<?=$teamPage->url()?>" class="btn btn-outline-primary"><i class="bi bi-person-heart"></i>
          <?=$teamPage->pageTitle()->isNotEmpty() ? $teamPage->pageTitle() : $teamPage->title()?></a></p>
</div>
<?php endif ?>