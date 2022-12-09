<?php
//TODO: get proper url
$measurePage="";
?>
<?php if (isset($viewedTeam['recommendations'])) :?>
<h4><?=t('Describe how and if your final design solution has met your context')?></h4>
<?php snippet('show-translatable-content', ['content'=>$viewedTeam['recommendations'], 'showButton'=> !$editTeam ]) ?>
  <?php if ($editTeam) :?>
  <a href="<?= $measurePage ?>" class="btn btn-outline-primary"><?=t('EDIT MEASURE','EDIT MEASURE')?></a>
  <?php snippet('show-appreciations', ['contentType'=>'Measures', 'contentId'=>$viewedTeam['team_measures_id']]) ?>
  <?php snippet('show-comments',['contentType'=>'Measures', 'contentId'=>$viewedTeam['team_measures_id']]) ?>
  <?php else : ?>
  <?php snippet('show-appreciation-button',['contentType'=>'Measures', 'contentId'=>$viewedTeam['team_measures_id']]) ?>
  <?php snippet('show-comment-box', ['contentType'=>'Measures', 'contentId'=>$viewedTeam['team_measures_id']])?>
  <?php endif; 
endif ?>