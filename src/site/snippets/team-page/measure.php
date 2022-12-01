<?php
//TODO: get proper url
$measurePage="";
?>
<?php if (isset($viewedTeam['recommendations'])) :?>
<h4><?=t('Describe how and if your final design solution has met your context')?></h4>
<?php snippet('show-translatable-content', ['content'=>$viewedTeam['recommendations'], 'showButton'=> !$editTeam ]) ?>
  <?php if ($editTeam) :?>
  <a href="<?= $measurePage ?>" class="btn btn-outline-primary"><?=$page->editMeasureButton()?></a>
  <?php snippet('show-appreciations', ['appreciations'=>$measureAppreciations]) ?>
  <?php snippet('show-comments',['comments'=>$measureComments]) ?>
  <?php else : ?>
  <?php snippet('show-appreciation-button',['appreciations'=>$measureAppreciations, 'contentType'=>'Measures', 'contentId'=>$viewedTeam['team_measures_id']]) ?>
  <?php snippet('show-comment-box', ['comments'=>$measureComments, 'contentType'=>'Measures', 'contentId'=>$viewedTeam['team_measures_id']])?>
  <?php endif; 
endif ?>