<?php
//TODO: get proper url
$contextPage="";
?>
<h3><?=t("Context")?></h3>
<?php snippet('show-translatable-content', ['content'=>$viewedTeam['context'], 'showButton'=> !$editTeam ]) ?>

<?php 
if ($editTeam) :
    if (isset($viewedTeam['area'])) :
      snippet('show-appreciations', ['appreciations'=>$contextAppreciations]);
      snippet('show-comments',['comments'=>$contextComments]);
?>
    <a href="<?= $contextPage ?>" class="btn btn-outline-primary"><?=$page->editContextButton()?></a>
    <?php else :
      snippet('show-appreciation-button',['appreciations'=>$contextAppreciations, 'contentType'=>'Challenge Definition', 'contentId'=>$viewedTeam['team_challenge_definition_id']]);
      snippet('show-comment-box', ['comments'=>$contextComments, 'contentType'=>'Challenge Definition', 'contentId'=>$viewedTeam['team_challenge_definition_id']]);
    endif;
endif; ?>