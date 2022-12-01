<?php

//TODO: create proper url
$areaPage="";

?>
<p><strong><?=t("Topic")?>: </strong><?=t($viewedTeam['area'], $viewedTeam['area']) ?></p>
<p><strong><?=t("Challenge")?>: </strong></p>
<?php snippet('show-translatable-content', ['content'=>$viewedTeam['challenge'], 'showButton'=> !$editTeam ]) ?>


<?php if ($editTeam) : ?>
  <?php snippet('show-appreciations', ['appreciations'=>$challengeAppreciations]) ?>
  <?php snippet('show-comments',['comments'=>$challengeComments]) ?>
<a href="<?= $areaPage ?>" class="btn btn-outline-primary"><?=$page->editChallengeButton()?></a>

<?php else: ?>
  <?php snippet('show-appreciation-button',['appreciations'=>$profileAppreciations, 'contentType'=>'Team Challenge', 'contentId'=>$viewedTeam['team_challenge_id']]) ?>
  <?php snippet('show-comment-box', ['comments'=>$profileComments, 'contentType'=>'Team Challenge', 'contentId'=>$viewedTeam['team_challenge_id']]) ?>
<?php endif ?>
