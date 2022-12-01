<?php
//TODO: update the proper url
$profilePage="";
?>
<?php snippet('show-translatable-content', ['content'=>$viewedTeam['description'], 'showButton'=> !$editTeam ]) ?>

<?php snippet('/team-page/skills-panel') ?>


<?php if ($editTeam): ?>
  <?php snippet('show-appreciations', ['appreciations'=>$profileAppreciations]) ?>
  <?php snippet('show-comments',['comments'=>$profileComments]) ?>
<a href="<?= $profilePage ?>" class="btn btn-outline-primary"><?=$page->editProfileButton()?></a>
<?php else: ?>
  <?php snippet('show-appreciation-button',['appreciations'=>$profileAppreciations, 'contentType'=>'Team Profile', 'contentId'=>$viewedTeam['profile_id']]) ?>
  <?php snippet('show-comment-box', ['comments'=>$profileComments, 'contentType'=>'Team Profile', 'contentId'=>$viewedTeam['profile_id']]) ?>
<?php endif ?>