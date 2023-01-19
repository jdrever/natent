<?php if ($userLoggedIn&&isset($team['area'])) : ?> 
<div class="alert alert-info" role="alert">
<i class="bi bi-info-square-fill"></i>
  <strong><?=t("Your team has previously selected a Topic and Challenge","Your team has previously selected a Topic and Challenge","Your team has previously selected a Topic and Challenge","Your team has previously selected a Topic and Challenge") ?></strong>
  <p><strong><?=t("Topic","Topic")?>: </strong><?=t($teamArea) ?><br />
    <strong><?=t("Challenge","Challenge")?>: </strong> <?=t($teamChallenge) ?></p>
</div>
<?php endif ?>

<?php if (!$userLoggedIn) : ?> 
<div class="alert alert-info" role="alert">
  <i class="bi bi-info-square-fill"></i>
  <strong><?=t("The example team selected the following Topic and Challenge","The example team selected the following Topic and Challenge") ?></strong>
  <p><strong><?=t("Topic","Topic")?>: </strong><?=t($teamArea) ?><br />
    <strong><?=t("Challenge","Challenge")?>: </strong> <?=t($teamChallenge) ?></p>
  <p><?=t("You can browse the Topics and Challenges, or click Next to continue the Learning Journey", "You can browse the Topics and Challenges, or click Next to continue the Learning Journey") ?>.</p>
</div>
<?php endif ?>