<h4><?=t('Describe how and if your final design solution has met your context')?></h4>
<?php if (isset($viewedTeam['recommendations'])) :?>
<?php snippet('show-translatable-content', ['content'=>$viewedTeam['recommendations'], 'showButton'=> !$editTeam ]) ?>
<?php if (!$hideCollaboration) : ?>
  <?php if ($editTeam) :?>
    <?php if ($measurePageUrl=getCollabUrl($collaborationPoints, 'task-measure')) :?>
  <a href="<?= $measurePageUrl ?>" class="btn btn-outline-primary"><?=t('EDIT MEASURE','EDIT MEASURE')?></a>
    <?php endif ?>
  <?php snippet('show-appreciations', ['contentType'=>'Measure', 'contentId'=>$viewedTeam['team_measures_id']]) ?>
  <?php snippet('show-comments',['contentType'=>'Measure', 'contentId'=>$viewedTeam['team_measures_id']]) ?>
  <?php else : ?>
  <?php snippet('show-appreciation-button',['contentType'=>'Measure', 'contentId'=>$viewedTeam['team_measures_id']]) ?>
  <?php snippet('show-comment-box', ['contentType'=>'Measure', 'contentId'=>$viewedTeam['team_measures_id']])?>
    <?php endif; 
    endif;
else:
?>
    <p><?=t("Not yet uploaded", "Not yet uploaded")?>.</p>
<?php endif ?>