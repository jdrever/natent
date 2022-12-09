<?php
//$teamPage = getTranslatedPageByTitle("Your Team Page");

$teamArea = $team['area'];
if (empty($teamArea)) $teamArea = t("Not yet selected");

$teamChallenge = $team['challenge'];
if (empty($teamChallenge)) $teamChallenge = t("Not yet selected");
?>

<div class="alert alert-info" role="alert">
  <p>
    <strong><?=t("Your team's selected Topic")?>: </strong> <?=$teamArea?>
    <br/>
    <strong><?=t("Your team's selected Challenge")?>: </strong> <?=$teamChallenge?>
  </p>
  <p><a href="<?/*php echo (get_permalink($teamPage))*/?>"><?= t("You can see full details on your Team Page") ?></a></p>
</div>