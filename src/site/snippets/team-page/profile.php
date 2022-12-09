<?php
//TODO: update the proper url
$profilePage="";
?>
<?php snippet('show-translatable-content', ['content'=>$viewedTeam['description'], 'showButton'=> !$editTeam ]) ?>

<?php snippet('/team-page/skills-panel') ?>


<?php if ($editTeam): ?>
  <?php snippet('show-appreciations', ['contentType'=>'Team Profile', 'contentId'=>$viewedTeam['profile_id']]) ?>
  <?php snippet('show-comments',['contentType'=>'Team Profile', 'contentId'=>$viewedTeam['profile_id']]) ?>
<a href="<?= $profilePage ?>" class="btn btn-outline-primary"><?=t('EDIT TEAM PROFILE','EDIT TEAM PROFILE')?></a>
<?php else: ?>
  <?php snippet('show-appreciation-button',['contentType'=>'Team Profile', 'contentId'=>$viewedTeam['profile_id']]) ?>
  <?php snippet('show-comment-box', ['contentType'=>'Team Profile', 'contentId'=>$viewedTeam['profile_id']]) ?>
<?php endif ?>

