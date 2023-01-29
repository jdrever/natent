
<?php snippet('show-translatable-content', ['content'=>$viewedTeam['description'], 'showButton'=> !$editTeam ]) ?>

<?php snippet('/team-page/skills-panel') ?>

<?php if (!$hideCollaboration) : ?>
  <?php if ($editTeam): ?>
  <?php snippet('show-appreciations', ['contentType'=>'Team Profile', 'contentId'=>$viewedTeam['profile_id']]) ?>
  <?php snippet('show-comments',['contentType'=>'Team Profile', 'contentId'=>$viewedTeam['profile_id']]) ?>
    <?php if ($profilePageUrl=getCollabUrl($collaborationPoints, 'task-team-profile')) :?>
      <a href="<?= $profilePageUrl ?>" class="btn btn-outline-primary"><?=t('EDIT TEAM PROFILE','EDIT TEAM PROFILE')?></a>
    <?php endif ?>
  <?php else: ?>
  <?php snippet('show-appreciation-button',['contentType'=>'Team Profile', 'contentId'=>$viewedTeam['profile_id']]) ?>
  <?php snippet('show-comment-box', ['contentType'=>'Team Profile', 'contentId'=>$viewedTeam['profile_id']]) ?>
  <?php endif ?>
  
<?php endif ?>
