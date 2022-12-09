<?php
//TODO: get proper url
$contextPage="";
?>
<h3><?=t("Context")?></h3>
<?php snippet('show-translatable-content', ['content'=>$viewedTeam['context'], 'showButton'=> !$editTeam ]) ?>

<?php 
if ($editTeam) :
    if (isset($viewedTeam['area'])) :
      snippet('show-appreciations', ['contentType'=>'Challenge Definition', 'contentId'=>$viewedTeam['team_challenge_definition_id']]);
      snippet('show-comments',['contentType'=>'Challenge Definition', 'contentId'=>$viewedTeam['team_challenge_definition_id']]);
?>
    <a href="<?= $contextPage ?>" class="btn btn-outline-primary"><?=t('EDIT CONTEXT')?></a>
    <?php else :
      snippet('show-appreciation-button',['contentType'=>'Challenge Definition', 'contentId'=>$viewedTeam['team_challenge_definition_id']]);
      snippet('show-comment-box', ['contentType'=>'Challenge Definition', 'contentId'=>$viewedTeam['team_challenge_definition_id']]);
    endif;
endif; ?>