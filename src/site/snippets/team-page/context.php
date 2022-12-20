<h3><?=t("Context")?></h3>
<?php snippet('show-translatable-content', ['content'=>$viewedTeam['context'], 'showButton'=> !$editTeam ]) ?>

<?php 
if (!$hideCollaboration) :
  if ($editTeam) :
    if (isset($viewedTeam['area'])) :
        snippet('show-appreciations', ['contentType'=>'Challenge Definition', 'contentId'=>$viewedTeam['team_challenge_definition_id']]);
        snippet('show-comments',['contentType'=>'Challenge Definition', 'contentId'=>$viewedTeam['team_challenge_definition_id']]);
    if ($contextPageUrl=getCollabUrl($collaborationPoints, 'task-share-context')) :?>
    <a href="<?= $contextPageUrl ?>" class="btn btn-outline-primary"><?=t('EDIT CONTEXT')?></a>
<?php 
    endif; 
  else :
        snippet('show-appreciation-button',['contentType'=>'Challenge Definition', 'contentId'=>$viewedTeam['team_challenge_definition_id']]);
        snippet('show-comment-box', ['contentType'=>'Challenge Definition', 'contentId'=>$viewedTeam['team_challenge_definition_id']]);
      endif;
  endif;
endif; ?>