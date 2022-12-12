<p><strong><?=t("Topic")?>: </strong><?=t($viewedTeam['area'], $viewedTeam['area']) ?></p>
<p><strong><?=t("Challenge")?>: </strong></p>
<?php snippet('show-translatable-content', ['content'=>$viewedTeam['challenge'], 'showButton'=> !$editTeam ]) ?>


<?php if ($editTeam) : ?>
  <?php snippet('show-appreciations', ['contentType'=>'Team Challenge', 'contentId'=>$viewedTeam['team_challenge_id']]) ?>
  <?php snippet('show-comments',['contentType'=>'Team Challenge', 'contentId'=>$viewedTeam['team_challenge_id']]) ?>

  <?php if ($topicPageUrl=getCollabUrl($collaborationPoints, 'task-select-topic')) :?>
<a href="<?= $topicPageUrl ?>" class="btn btn-outline-primary"><?=t('EDIT TOPIC AND CHALLENGE','EDIT TOPIC AND CHALLENGE')?></a>
  <?php endif ?>

<?php else: ?>
  <?php snippet('show-appreciation-button',['contentType'=>'Team Challenge', 'contentId'=>$viewedTeam['team_challenge_id']]) ?>
  <?php snippet('show-comment-box', ['contentType'=>'Team Challenge', 'contentId'=>$viewedTeam['team_challenge_id']]) ?>
<?php endif ?>

